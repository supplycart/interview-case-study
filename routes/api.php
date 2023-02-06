<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\OrdersController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::prefix('/cart')->name('cart.')->group(function () {
        Route::get('/', [ShoppingCartController::class, 'index'])->name('index');
        Route::post('/add/{product:id}', [ShoppingCartController::class, 'add'])->name('add');
        Route::post('/remove/{product:id}', [ShoppingCartController::class, 'remove'])->name('remove');
        // Route::post('/update-quantity/{product:id}', [ShoppingCartController::class, 'updateQuantity'])->name('update-quantity');
    });
    Route::prefix('/orders')->name('orders.')->group(function () {
        Route::get('/', [OrdersController::class, 'index'])->name('index');
        Route::post('/', [OrdersController::class, 'store'])->name('store');
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/product', \App\Http\Controllers\ProductController::class);

});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
