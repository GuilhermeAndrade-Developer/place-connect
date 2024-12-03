<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShopeeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Log da requisição recebida para debug (opcional)
        Log::info('Shopee Webhook Received', $request->all());

        // Validação opcional do webhook
        $authorizationHeader = $request->header('Authorization');
        $isValid = $this->verifyShopeePush(
            $request->url(),
            $request->getContent(),
            env('SHOPEE_PARTNER_KEY'),
            $authorizationHeader
        );

        if (!$isValid) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        // Processar os dados recebidos
        $data = $request->all();
        $eventCode = $data['code'] ?? null;

        // Salvar os dados no banco
        \App\Models\ShopeeWebhookLog::create([
            'event_code' => $eventCode,
            'payload' => json_encode($data),
        ]);

        // Ações específicas para eventos
        switch ($eventCode) {
            case 1: // Autorização de loja
                Log::info('Shop Authorized', $data);
                break;
            case 3: // Atualização de status de pedido
                Log::info('Order Status Updated', $data);
                break;
            default:
                Log::info('Unhandled Shopee Webhook Event', $data);
                break;
        }

        // Retornar resposta 2xx para indicar sucesso
        return response()->json(['success' => true], 200);
    }

    private function verifyShopeePush($url, $requestBody, $partnerKey, $authorization)
    {
        $baseString = $url . '|' . $requestBody;
        $calculatedAuth = hash_hmac('sha256', $baseString, $partnerKey);

        return hash_equals($calculatedAuth, $authorization);
    }
}
