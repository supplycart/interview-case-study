<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

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
})->name('home');

Route::group(['middleware' => ['auth']], function() {
    //Product Module
    Route::get('product','ProductController@index')->name('product');
    Route::get('sort-product/{option?}/{value?}','ProductController@sort')->name('sort.product');

    //Cart Module
    Route::get('cart','CartController@index')->name('cart');
    Route::post('add-cart','CartController@store')->name('add.cart');
    Route::post('remove-cart','CartController@destroy')->name('remove.cart');

    //Order Module
    Route::get('order','OrderController@index')->name('order');
    Route::post('add-order','OrderController@store')->name('add.order');

    //Trail Module
    Route::get('trail','TrailController@index')->name('trail');
});

require __DIR__.'/auth.php';