<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {

    if (Auth::check())
    {
        return redirect()->route('user.dashboard');
    }
    else
    {
        return Inertia::render('Welcome');
    }
})->name('home');

Route::middleware(['auth', 'verified'])->group(function() {

    Route::group([
        'prefix' => 'user',
        'as' => 'user.',
    ], function() {
        Route::get('dashboard', [ App\Http\Controllers\Web\DashboardController::class, 'index' ])->name('dashboard');
        Route::get('product', [ App\Http\Controllers\Web\User\ProductController::class, 'index' ])->name('product');

        Route::resource('cart', App\Http\Controllers\Web\User\CartController::class, [ 'except' => 'store' ]);
        Route::post('cart', [ App\Http\Controllers\Web\User\CartController::class, 'store' ])->name('add-to-cart');

        Route::resource('order', App\Http\Controllers\Web\User\OrderController::class);
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
