<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopeeController;
use App\Http\Controllers\ShopeeAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Shopee
Route::get('/shopee/generate-auth-link', [ShopeeAuthController::class, 'generateAuthLink']);
Route::get('/shopee/auth/callback', [ShopeeAuthController::class, 'handleCallback']);
Route::post('/shopee/get-access-token', [ShopeeAuthController::class, 'getAccessToken']);
Route::get('/shopee/shop-info', [ShopeeController::class, 'getShopInfo']);

require __DIR__ . '/auth.php';
