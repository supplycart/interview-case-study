<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'view')->name('cart.view');
    Route::post('/cart', 'addItemToCart')->name('cart.add');
})->middleware(['auth', 'verified'])->name('cart');

Route::controller(OrderController::class)->group(function () {
    Route::get('/order', 'view')->name('order.view');
    Route::get('/order/{orderId}', 'detail');
    Route::post('/order/checkout', 'checkout')->name('order.checkout');
})->middleware(['auth', 'verified'])->name('order');

Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'view')->name('product.view');
    Route::get('/product/{productId}', 'detail');
    Route::get('/product/order/{productId}', 'orderDetail')->middleware(['auth', 'verified']);
})->name('product');

require __DIR__.'/auth.php';
