<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;

class ShopeeAuthService
{
    protected $partnerId;
    protected $partnerKey;
    protected $host;

    public function __construct()
    {
        $this->partnerId = env('SHOPEE_PARTNER_ID');
        $this->partnerKey = env('SHOPEE_PARTNER_KEY');
        $this->host = env('SHOPEE_API_HOST', 'https://partner.shopeemobile.com');
    }

    /**
     * Gera o link de autorização para uma loja.
     */
    public function generateAuthLink($redirectUrl)
    {
        $timestamp = time();
        $path = '/api/v2/shop/auth_partner';
        $baseString = $this->partnerId . $path . $timestamp;

        $signature = hash_hmac('sha256', $baseString, $this->partnerKey);

        $url = "{$this->host}{$path}?partner_id={$this->partnerId}&timestamp={$timestamp}&sign={$signature}&redirect={$redirectUrl}";

        return $url;
    }

    /**
     * Obter o access token usando o código de autorização e shop_id.
     */
    public function getAccessToken($code, $shopId)
    {
        $timestamp = time();
        $path = '/api/v2/auth/token/get';
        $baseString = "{$this->partnerId}{$path}{$timestamp}";

        $signature = hash_hmac('sha256', $baseString, $this->partnerKey);

        $url = "{$this->host}{$path}?partner_id={$this->partnerId}&timestamp={$timestamp}&sign={$signature}";

        $body = [
            'code' => $code,
            'shop_id' => $shopId,
            'partner_id' => $this->partnerId,
        ];

        $response = (new \GuzzleHttp\Client())->post($url, [
            'json' => $body,
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        return json_decode($response->getBody(), true);
    }
}
