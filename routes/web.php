<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/product', 'ProductsController@index');

Route::get('cart', 'CartsController@index');
Route::get('add-to-cart/{id}', 'CartsController@addToCart');
Route::patch('update-cart', 'CartsController@update');
Route::delete('remove-from-cart', 'CartsController@remove');

Route::get('/order', 'OrdersController@index');
Route::post('/order', 'OrdersController@create');
Route::get('/order/{id}', 'OrdersController@getOrderById');
Route::get('/order/user/{id}', 'OrdersController@getOrderByUserId');
