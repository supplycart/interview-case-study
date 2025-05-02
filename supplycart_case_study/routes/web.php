<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    if (auth()->check()) {
        return redirect()->route('products.index');
    }
    return redirect()->route('login');
})->name('home');

Route::get('dashboard', function () {
    return redirect()->route('products.index');
    // return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('products', ProductController::class)->only([
    'index', 'show'
])->middleware(['auth', 'verified']);

Route::resource('carts', CartController::class)->only([
    'index', 'store', 'show', 'destroy'
])->middleware(['auth', 'verified']);

Route::post('/carts/sync', [CartController::class, 'sync'])->middleware(['auth']);

Route::get('/checkout', fn () => Inertia::render('Checkout'))->middleware('auth')->name('checkout');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
