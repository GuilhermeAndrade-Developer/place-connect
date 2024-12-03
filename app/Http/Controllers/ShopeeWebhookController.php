<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopeeWebhookLog;
use App\Models\ShopeeShop;
use App\Models\ShopeeUpdate;
use Carbon\Carbon;

class ShopeeWebhookController extends Controller
{
    /**
     * Lida com todos os tipos de webhooks da Shopee.
     */
    public function handle(Request $request)
    {
        $payload = $request->all();
        $code = $payload['code'];

        // Salve o log do webhook no banco de dados
        ShopeeWebhookLog::create([
            'event_type' => $this->getEventType($code),
            'data' => $payload,
        ]);

        // Processa os diferentes tipos de eventos
        switch ($code) {
            case 1: // shop_authorization_push
                $this->processShopAuthorization($payload);
                break;

            case 2: // shop_authorization_canceled_push
                $this->processShopDeauthorization($payload);
                break;

            case 12: // open_api_authorization_expiry
                $this->processAuthorizationExpiry($payload);
                break;

            case 5: // shopee_updates
                $this->processShopeeUpdates($payload);
                break;

            default:
                // Caso o evento não seja reconhecido
                return response()->json(['message' => 'Event not recognized'], 400);
        }

        return response()->json(['message' => 'Webhook received'], 200);
    }

    /**
     * Retorna o tipo de evento com base no código.
     */
    protected function getEventType($code)
    {
        $eventTypes = [
            1 => 'shop_authorization_push',
            2 => 'shop_authorization_canceled_push',
            12 => 'open_api_authorization_expiry',
            5 => 'shopee_updates',
        ];

        return $eventTypes[$code] ?? 'unknown_event';
    }

    /**
     * Processa o evento de autorização de loja.
     */
    protected function processShopAuthorization(array $payload)
    {
        $shopId = $payload['data']['shop_id'] ?? null;
        $shopIdList = $payload['data']['shop_id_list'] ?? [];

        if ($shopId) {
            // Atualizar ou criar o registro da loja
            ShopeeShop::updateOrCreate(
                ['shop_id' => $shopId],
                [
                    'access_token' => null,
                    'refresh_token' => null,
                    'token_expires_at' => null,
                ]
            );
        }

        foreach ($shopIdList as $id) {
            // Atualizar ou criar múltiplas lojas
            ShopeeShop::updateOrCreate(
                ['shop_id' => $id],
                [
                    'access_token' => null,
                    'refresh_token' => null,
                    'token_expires_at' => null,
                ]
            );
        }
    }

    /**
     * Processa o evento de desautorização de loja.
     */
    protected function processShopDeauthorization(array $payload)
    {
        $shopId = $payload['data']['shop_id'] ?? null;
        $shopIdList = $payload['data']['shop_id_list'] ?? [];

        if ($shopId) {
            // Remover o registro ou atualizar como desautorizado
            ShopeeShop::where('shop_id', $shopId)->update([
                'access_token' => null,
                'refresh_token' => null,
                'token_expires_at' => null,
            ]);
        }

        foreach ($shopIdList as $id) {
            ShopeeShop::where('shop_id', $id)->update([
                'access_token' => null,
                'refresh_token' => null,
                'token_expires_at' => null,
            ]);
        }
    }

    /**
     * Processa o evento de autorização expirando (code: 12).
     */
    protected function processAuthorizationExpiry(array $payload)
    {
        $shops = $payload['data']['shop_expire_soon'] ?? [];
        $expireBefore = $payload['data']['expire_before'];

        foreach ($shops as $shopId) {
            $shop = ShopeeShop::firstWhere('shop_id', $shopId);

            if ($shop) {
                $shop->update([
                    'expiration_notice_at' => now(),
                    'expiration_notified' => true,
                    'token_expires_at' => Carbon::createFromTimestamp($expireBefore),
                ]);
            }
        }
    }

    /**
     * Processa o evento de atualizações da Shopee (code: 5).
     */
    protected function processShopeeUpdates(array $payload)
    {
        $shopId = $payload['shop_id'] ?? null;
        $updates = $payload['data']['actions'] ?? [];

        if (!$shopId) {
            return;
        }

        foreach ($updates as $update) {
            ShopeeUpdate::create([
                'shop_id' => $shopId,
                'title' => $update['title'],
                'content' => $update['content'],
                'url' => $update['url'] ?? null,
                'update_time' => Carbon::createFromTimestamp($update['update_time']),
            ]);
        }
    }
}
