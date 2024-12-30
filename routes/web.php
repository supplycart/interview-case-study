<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

    Route::resource('products', ProductController::class)
    ->only(['index', 'show']);

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'show'])->name('cart.show');
        Route::post('/', [CartController::class, 'addToCart'])->name('cart.add');
        Route::patch('/quantity', [CartController::class, 'updateQuantity'])->name('cart.update.quantity');
        Route::delete('/cart-item', [CartController::class, 'deleteCartItem'])->name('cart.delete.item');
    });
});

require __DIR__ . '/auth.php';
