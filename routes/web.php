<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => ['auth', 'verified']], function() {    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post('orders', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::get('orders/create', [App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
    Route::get('orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');

    Route::group(['prefix' => 'carts', 'as' => 'carts.'], function() {
        Route::post('cart-all-destroy', [App\Http\Controllers\CartController::class, 'allDestroy'])->name('cart-all-destroy');
        Route::post('{id}/cart-destroy', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart-destroy');
        Route::post('cart-store', [App\Http\Controllers\CartController::class, 'store'])->name('cart-store');
        Route::get('cart-list-items', [App\Http\Controllers\CartController::class, 'index'])->name('cart-list-items');
    });

    Route::get('{id}/product-detail', [App\Http\Controllers\ProductController::class, 'show'])->name('product-detail');
});