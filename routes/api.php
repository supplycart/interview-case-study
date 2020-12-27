<?php

use Illuminate\Http\Request;

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

Route::middleware('api')->namespace('Auth')->prefix('auth')->group(function() {
    Route::resource( 'products', 'ProductController');
    Route::resource( 'brands', 'BrandController');
    Route::resource( 'categories', 'CategoryController');
    Route::resource( 'orders', 'OrderController');
    Route::resource( 'cart', 'CartController', ['except' => [
        'destroy'
    ]]);
    Route::delete('/cart', 'CartController@deleteCart');
    Route::delete('/cart/{id}', 'CartController@delete');
});

Route::namespace('Auth')->prefix('auth')->group(function() {
    Route::middleware('api')->group(function() {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });
    Route::post('register', 'AuthController@register');
});
