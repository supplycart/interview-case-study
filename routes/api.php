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

Route::middleware('auth:api')->get('/user-name', function (Request $request) {

    return response()->json(['name' => Auth::User()], 200);

});
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/orders', 'OrderController@index');
    Route::post('logout','UserController@logoutApi');
    Route::get('/cart',  'CartController@index');
    Route::post('/add-to-cart', 'CartController@additem');
    Route::post('/checkout', 'CartController@checkout');
    Route::get('/orders',  'OrderController@index');
    Route::get('/products', 'ProductController@index');
});

//Route::get('/cart', 'CartController@index');

