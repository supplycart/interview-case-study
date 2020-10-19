<?php

use App\Http\Controllers\API\Brand\BrandController;
use App\Http\Controllers\API\Category\CategoryController;
use App\Http\Controllers\API\Order\OrderController;
use App\Http\Controllers\API\Product\ProductController;
use App\Http\Controllers\API\UserController;
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
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout']);
Route::get('user/{id}/confirm_email', [UserController::class, 'confirmEmail']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user/{id}/order_history', [UserController::class, 'getOrderHistory']);
    Route::post('details', [UserController::class, 'getDetails']);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
});
