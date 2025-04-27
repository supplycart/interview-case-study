<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('dashboard', [ItemController::class, 'index'])->name('dashboard');

    Route::get('cart', [CartController::class, 'index'])->name('cart');
    
    Route::post('add_to_cart', [CartController::class, 'store'])->name('add_to_cart');
    
    Route::post('place_order', [OrderController::class, 'store'])->name('place_order');
    
    Route::get('orders', [OrderController::class, 'index'])->name('orders');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
