<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ShopeeApiService;

class ShopeeController extends Controller
{
    protected $shopeeApi;

    public function __construct(ShopeeApiService $shopeeApi)
    {
        $this->shopeeApi = $shopeeApi;
    }

    /**
     * Obter informações da loja.
     */
    public function getShopInfo()
    {
        $path = '/api/v2/shop/get_shop_info';
        $shopId = 123456; // Substitua pelo ID da loja real
        $accessToken = 'your_access_token'; // Substitua pelo token de acesso real

        try {
            $response = $this->shopeeApi->request('GET', $path, [], $accessToken, $shopId);

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
