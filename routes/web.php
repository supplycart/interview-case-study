<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\OrderController;
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

Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth'])->name('admin');

Route::group(
    [
        'prefix' => 'app',
        'middleware' => ['auth']
    ],
    function ()
    {
        Route::get('/', [ProductController::class, 'index'])->name('app');
        Route::get('/product/{product}', [ProductController::class, 'show'])->name('product-detail');
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::post('/cart/{product}', [CartController::class, 'store'])->name('add-product-to-cart');
        Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('remove-product-from-cart');
        Route::put('/cart/{product}', [CartController::class, 'update'])->name('update-cart-quantity');
        Route::post('/orders', [OrderController::class, 'store'])->name('store-orders');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders-detail');
    }
);


require __DIR__.'/auth.php';
