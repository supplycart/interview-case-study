<?php

use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product_id}', [ProductController::class, 'show'])->where('product_id', '[0-9_\-]+')->name('products.show');
Route::get('/get_cart', [ProductController::class, 'getCart'])->name('get_cart');
Route::post('/checkout', [ProductController::class, 'postCheckout'])->name('post_checkout');

Route::middleware('auth:sanctum')->get('/get_user_orders', [OrderController::class, 'getUserOrders'])->name('get_user_orders');
