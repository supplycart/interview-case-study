<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\User\ProductController as UserProductController;
use App\Http\Controllers\Web\User\CartController as UserCartController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('dashboard', [ DashboardController::class, 'index' ])->name('dashboard');

    Route::get('product', [ UserProductController::class, 'index' ])->name('product');

    Route::resource('cart', UserCartController::class, [ 'except' => 'store' ]);
    Route::post('cart', [ UserCartController::class, 'store' ])->name('add-to-cart');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
