<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;


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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => [
    'auth', 'verified'
]], function() {
    Route::get('/', function () {
        return redirect()->route('products.index');
    });

    Route::name('products.')->prefix('products')->group(function() {
        Route::get('/', [ProductController::class, 'index'])->name('index');
    });

    Route::name('carts.')->prefix('carts')->group(function() {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('add', [CartController::class, 'addToCart'])->name('addToCart');
        Route::post('checkout', [CartController::class, 'checkout'])->name('checkout');
    });

    Route::name('orders.')->prefix('orders')->group(function() {
        Route::get('/', [OrderController::class, 'index'])->name('index');
    });
});
require __DIR__.'/auth.php';
