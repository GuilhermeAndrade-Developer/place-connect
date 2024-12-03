<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopeeController;
use App\Http\Controllers\ShopeeAuthController;
use App\Http\Controllers\ShopeeWebhookController;
use Illuminate\Support\Facades\Route;

// Página Inicial
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Apenas Usuários Autenticados)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Perfil de Usuário
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Shopee API e Webhooks
Route::prefix('shopee')->group(function () {
    Route::get('/generate-auth-link', [ShopeeAuthController::class, 'generateAuthLink']);
    Route::get('/auth/callback', [ShopeeAuthController::class, 'handleCallback']);
    Route::post('/get-access-token', [ShopeeAuthController::class, 'getAccessToken']);
    Route::post('/webhook', [ShopeeWebhookController::class, 'handle']);

    // Rotas restritas a usuários autenticados
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/shop-info', [ShopeeController::class, 'getShopInfo']);
    });
});

// Rotas de Autenticação
require __DIR__ . '/auth.php';
