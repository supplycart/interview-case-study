<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Main\OrderController;
use App\Http\Controllers\Main\GoodController;
use App\Http\Controllers\Main\CheckoutController;
use App\Http\Controllers\Main\CartController;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // goods prefixed routes
    Route::prefix('goods')->controller(GoodController::class)->group(function () {
        Route::get('', 'goods')->name('goods.index');  
        Route::get('{good}/general', 'index')->name('goods.good.general');
        Route::get('{good}/properties', 'properties')->name('goods.good.properties');
    });

    // cart prefixed routes
    Route::prefix('cart')->controller(CartController::class)->group(function () {
        Route::post('store/{good}', 'store')->name('cart.store');
        Route::patch('update/{good}', 'update')->name('cart.update');
        Route::delete('delete/{good}', 'delete')->name('cart.delete');
        Route::delete('bulk-delete', 'bulkDelete')->name('cart.bulk-delete');
    });

    // checkout prefixed routes
    Route::prefix('checkout')->controller(CheckoutController::class)->group(function () {   
        Route::get('', 'index')->name('checkout.index');
        Route::post('order', 'store')->name('checkout.store');
        Route::get('success', 'success')->name('checkout.success');
        Route::get('cancel', 'cancel')->name('checkout.cancel');
    });

    // order prefixed routes
    Route::prefix('orders')->controller(OrderController::class)->group(function () {
        Route::get('', 'index')->name('orders.index');
    });
});

require __DIR__.'/auth.php';
