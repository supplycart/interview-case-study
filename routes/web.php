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
    return view('pages.index');
});

Route::resource('products', 'ProductsController', ['only' => [
    'index'
]])->middleware(['auth']);

Route::resource('orders', 'OrdersController', ['only' => [
    'store',
    'index',
]])->middleware(['auth']);;

Route::get('cart', 'CartController@index')->middleware(['auth']);;
// Route::get('orders/view_order_history', 'OrdersController@viewOrderHistory');

Route::post('user_orders', 'UserOrdersController@store')->middleware(['auth']);;
// Route::post('orders/place_order', 'OrdersController@placeOrder');

Auth::routes(['verify' => true]);

