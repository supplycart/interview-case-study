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
        Route::get('categories', 'CategoryController@index');
        Route::get('brands', 'BrandController@index');
        Route::get('products', 'ProductController@index');

        Route::resource('carts', 'CartController');
    }
);
Route::middleware('auth:sanctum')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
)->middleware('verified');
