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

Route::get('/app', [ProductController::class, 'index'])->middleware(['auth'])->name('app');
Route::get('/app/product/{product}', [ProductController::class, 'show'])->middleware(['auth'])->name('product-detail');
Route::get('/cart', [CartController::class, 'index'])->middleware(['auth'])->name('cart');
Route::post('/cart/{product}', [CartController::class, 'store'])->middleware(['auth'])->name('add-product-to-cart');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->middleware(['auth'])->name('remove-product-from-cart');
Route::put('/cart/{product}', [CartController::class, 'update'])->middleware(['auth'])->name('update-cart-quantity');
Route::post('/orders', [OrderController::class, 'store'])->middleware(['auth'])->name('store-orders');
Route::get('/orders', [OrderController::class, 'index'])->middleware(['auth'])->name('orders');
Route::get('/orders/{order}', [OrderController::class, 'show'])->middleware(['auth'])->name('orders-detail');

require __DIR__.'/auth.php';
