<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::name('api.')->middleware(['auth', 'api', 'verified'])->group(function () {
	Route::get('/categories', [ApiController::class, 'getCategories'])->name('category.list');
    Route::get('/products', [ApiController::class, 'getProducts'])->name('product.list');
    Route::post('/cart', [ApiController::class, 'updateCart'])->name('cart.update');
    Route::get('/cart', [ApiController::class, 'getCart'])->name('cart.read');
    Route::post('/orders', [ApiController::class, 'createOrder'])->name('order.create');
    Route::get('/orders', [ApiController::class, 'getOrders'])->name('order.list');
    Route::get('/activities', [ApiController::class, 'getActivities'])->name('activity.list');
});
