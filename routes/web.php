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
]]);

Route::resource('orders', 'OrdersController', ['only' => [
    'store'
]]);

Route::get('orders/view_order_history', 'OrdersController@viewOrderHistory');

Route::get('user_orders/add_item_to_cart/{product_id}', 'UserOrdersController@addItemToCart');
// Route::post('orders/place_order', 'OrdersController@placeOrder');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
