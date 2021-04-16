<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'shop', 'as' => 'shop.'], function () {
        Route::get('/', [ShopController::class, 'index'])->name('index');
        Route::get('products', [ShopController::class, 'getProductsByCategory'])->name('get_product_by_category');
    });

    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::group(['prefix' => 'item', 'as' => 'item.'], function () {
            Route::post('add', [CartController::class, 'addItem'])->name('add');
            Route::delete('delete', [CartController::class, 'deleteItem'])->name('delete');
        });
    });

    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::post('place', [OrderController::class, 'place'])->name('place');
        Route::get('show/{order}', [OrderController::class, 'show'])->name('show');
    });

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('show/{product}', [ProductController::class, 'show'])->name('show');
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('upgrade', [ProfileController::class, 'upgrade'])->name('upgrade');
    });
});

require __DIR__.'/auth.php';
