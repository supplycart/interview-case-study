<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/',  'login')->name('login.index');
Route::post('login', 'AuthController@login')->name('login');
Route::view('register', 'register')->name('register.index');
Route::post('add_user', 'AuthController@register')->name('register');
Route::get('index', 'DashboardController@index')->name('home');

Route::prefix('customer')->group(function (){
    Route::get('/list', 'CustomerController@list')->name('customer_list');
});

Route::prefix('product')->group(function (){
    Route::get('/list', 'ProductController@list')->name('product.list');
});

Route::prefix('transaction')->group(function (){
    Route::get('/list', 'TransactionController@list')->name('transaction.list');
});

Route::prefix('order')->group(function (){
    Route::get('/list', 'OrderController@list')->name('order.list');
});

Route::view('reset_password','reset_password')->name('reset_password');
