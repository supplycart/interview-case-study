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


Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');


Route::group(
    [
        'middleware' => 'auth:sanctum',
    ],
    function () {
        Route::post('logout', 'AuthController@logout');
        Route::post('upgrade', 'AuthController@upgrade');
        Route::get('categories', 'CategoryController@index');
        Route::get('brands', 'BrandController@index');
        Route::get('products', 'ProductController@index');
        Route::get('activities', 'ActivityController@index');

        Route::post('carts/sync', 'CartController@sync');
        Route::apiResource('carts', 'CartController')->except(['show']);
        Route::apiResource('orders', 'OrderController')->except(['destroy']);

        Route::get(
            '/user',
            function (Request $request) {
                return $request->user();
            }
        )->middleware('verified');
    }
);

