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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/search', 'HomeController@search')->name('home.search');
Route::post('/addtocart/{productId}', 'HomeController@addToCart')->name('add.to.cart');
Route::post('/checkout', 'HomeController@checkout')->name('checkout');
Route::get('/activitylogs', 'HomeController@activityLog')->name('activity.logs');
Route::post('/payment/fail', 'HomeController@paymentFail')->name('payment.fail');
Route::post('/payment/success', 'HomeController@paymentSuccess')->name('payment.success');
Route::get('/purchasehistory', 'HomeController@purchasehistory')->name('purchase.history');
