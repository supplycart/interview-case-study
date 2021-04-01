<?php

use \App\Http\Controllers\OrderController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::prefix('user')->group(function () {
        Route::get('/activity', [UserController::class, 'activity'])->name('user.activity');
        Route::get('/cart', [ProductController::class, 'cart'])->name('user.cart');
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('user.checkout');
        Route::get('/order-history', [OrderController::class, 'index'])->name('user.order-history');
    });

    Route::get('/products', [ProductController::class, 'index'])
        ->name('product.index');
});
