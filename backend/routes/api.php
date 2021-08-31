<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

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

// register endpoint
Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);

// login endpoint
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);


// route everything with /product to ProductController
Route::resource('/product', \App\Http\Controllers\ProductController::class);

// all endpoint inside here require authentication
Route::middleware(['auth:sanctum'])->group(function (){

    // logout endpoint
    Route::post('/logout', [\App\Http\Controllers\UserController::class, 'logout']);

    // add to cart endpoint
    Route::post('/cart/add-to-cart', [\App\Http\Controllers\CartController::class, 'AddToCart']);

    // find cart endpoint
    Route::get('/cart/find-cart', [\App\Http\Controllers\CartController::class, 'FindCart']);

    // checkout cart
    Route::post('/cart/checkout', [\App\Http\Controllers\CartController::class, 'checkoutCart']);

    // get completed order
    Route::get('/order', [\App\Http\Controllers\OrderController::class, 'getOrder']);


});


