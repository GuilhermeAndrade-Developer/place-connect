<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ShopeeApiService
{
    protected $client;
    protected $partnerId;
    protected $partnerKey;
    protected $host;

    public function __construct()
    {
        $this->client = new Client();
        $this->partnerId = env('SHOPEE_PARTNER_ID');
        $this->partnerKey = env('SHOPEE_PARTNER_KEY');
        $this->host = env('SHOPEE_API_HOST', 'https://partner.shopeemobile.com');
    }

    protected function getTimestamp()
    {
        return time();
    }

    protected function generateSignature($path, $timestamp, $accessToken = null, $shopId = null)
    {
        $baseString = $this->partnerId . $path . $timestamp;

        if ($accessToken) {
            $baseString .= $accessToken;
        }

        if ($shopId) {
            $baseString .= $shopId;
        }

        return hash_hmac('sha256', $baseString, $this->partnerKey);
    }

    public function request($method, $path, $parameters = [], $accessToken = null, $shopId = null)
    {
        $timestamp = $this->getTimestamp();
        $signature = $this->generateSignature($path, $timestamp, $accessToken, $shopId);

        $url = "{$this->host}{$path}?partner_id={$this->partnerId}&timestamp={$timestamp}&sign={$signature}";

        if ($accessToken) {
            $url .= "&access_token={$accessToken}";
        }

        if ($shopId) {
            $url .= "&shop_id={$shopId}";
        }

        try {
            $response = $this->client->request($method, $url, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $parameters,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("Shopee API Error: " . $e->getMessage());
            throw $e;
        }
    }
}
