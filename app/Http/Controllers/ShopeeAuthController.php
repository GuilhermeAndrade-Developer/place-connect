<?php

namespace App\Http\Controllers;

use App\Services\ShopeeAuthService;
use Illuminate\Http\Request;

class ShopeeAuthController extends Controller
{
    protected $shopeeAuthService;

    public function __construct(ShopeeAuthService $shopeeAuthService)
    {
        $this->shopeeAuthService = $shopeeAuthService;
    }

    /**
     * Gerar o link de autorização.
     */
    public function generateAuthLink(Request $request)
    {
        $redirectUrl = 'https://seusite.com/shopee/auth/callback'; // Substitua pelo seu URL de callback
        $authLink = $this->shopeeAuthService->generateAuthLink($redirectUrl);

        return response()->json(['auth_link' => $authLink]);
    }

    /**
     * Gerenciar o callback após autorização.
     */
    public function handleCallback(Request $request)
    {
        $code = $request->query('code');
        $shopId = $request->query('shop_id');

        if (!$code || !$shopId) {
            return response()->json(['error' => 'Faltando parâmetros necessários'], 400);
        }

        // Salve o código e shop_id no banco, se necessário
        return response()->json(['message' => 'Autorização concluída', 'code' => $code, 'shop_id' => $shopId]);
    }

    /**
     * Obter o access token.
     */
    public function getAccessToken(Request $request)
    {
        $shopId = $request->input('shop_id');
        $code = $request->input('code');

        if (!$shopId || !$code) {
            return response()->json(['error' => 'Parâmetros inválidos'], 400);
        }

        $response = $this->shopeeAuthService->getAccessToken($code, $shopId);

        // Salve o `access_token` e `refresh_token` no banco, se necessário
        return response()->json($response);
    }
}
