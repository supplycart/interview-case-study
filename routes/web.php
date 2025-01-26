<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Inertia\Inertia;

Route::get('/', function () {
    $products = Product::all()->toArray();
    return Inertia::render('Dashboard',[
        'products' => $products,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //cart routes
    Route::get('/cart/count', [CartController::class, 'countCartItems'])->name('cart.item.count');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/items', [CartController::class, 'getCartItems'])->name('cart.items');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    //order routes
    Route::get('/order', [OrderController::class, 'Orders'])->name('order.page');
    Route::get('/order/summary/{id}', [OrderController::class, 'orderSummary'])->name('order.summary');

    //profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
