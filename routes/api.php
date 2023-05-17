<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\OrderApiController;

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

Route::middleware(['auth:api', 'verified'])->group(function () {

    Route::get('/product', [ProductApiController::class, 'index'])->name('api.product.index');

    Route::get('/product/{id}', [ProductApiController::class, 'show'])->name('api.product.show');

    Route::post('/product', [ProductApiController::class, 'store'])->name('api.product.store');

    Route::get('/brand', [ProductApiController::class, 'brand'])->name('api.product.brand');

    Route::get('/category', [ProductApiController::class, 'category'])->name('api.product.category');

    Route::get('/cart', [CartApiController::class, 'index'])->name('api.cart.index');

    Route::get('/cart/{id}/delete', [CartApiController::class, 'destroy'])->name('api.cart.destroy');

    Route::post('/order/checkout', [OrderApiController::class, 'store'])->name('api.order.checkout');

    Route::get('/order', [OrderApiController::class, 'index'])->name('api.order.history');

});
