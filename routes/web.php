<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::group(['prefix' => 'products'], function() {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('{product:slug}', [ProductController::class, 'show'])->name('products.show');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'cart', 'as' => 'cart'], function() {
        Route::get('/', [CartController::class, 'index'])->name('');
        Route::post('add-to-cart', [CartController::class, 'store'])->name('.add');
        Route::post('update-from-cart', [CartController::class, 'update'])->name('.update');
        Route::post('remove-from-cart', [CartController::class, 'destroy'])->name('.remove');
        Route::post('checkout', [CartController::class, 'checkout'])->name('.checkout');
    });

    // Order
    Route::group(['prefix' => 'orders', 'as' => 'orders'], function() {
        Route::get('/', [OrderController::class, 'index'])->name('.index');
        Route::get('{order}', [OrderController::class, 'show'])->name('.show');
    });
});

require __DIR__.'/auth.php';
