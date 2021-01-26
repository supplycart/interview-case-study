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

Route::group(['middleware' => ['auth']], function () {
    // Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/cart', 'CartController@index');
    Route::get('/cart/add/{id}', 'CartController@add');
    Route::patch('/cart/update', 'CartController@update');
    Route::delete('/cart/remove', 'CartController@remove');
    Route::get('/checkout/{total_price}', 'CheckoutController@getCheckout')->name('checkout.index');
    Route::get('/order', 'OrderController@index'); 
    Route::post('/order/place', 'OrderController@place')->name('place.order'); 
});

Auth::routes();
Route::view('/ui', 'ui.index');


