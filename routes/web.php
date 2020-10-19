<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('index');
});

Route::get('/index', 'UserController@index')->name('index');
Route::post('/login', 'UserController@login')->name('user_login');
Route::post('/register', 'UserController@register')->name('user_register');
Route::get('/logout', 'UserController@logout')->name('user_logout');
Route::get('/products/list', 'ProductController@get')->name('product_list');
Route::post('/cart/add', 'ProductController@addToCart')->name('cart_add');
Route::get('/order/history', 'ProductController@getOrderHistory')->name('order_history');
Route::post('/order/place', 'ProductController@placeOrders')->name('order_place');