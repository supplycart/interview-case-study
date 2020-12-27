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

// Auth::routes();


Route::group(['middleware' => ['auth']], function() {
    // Route::get('/home', 'User\PizzaController@index')->name('user.pizza.index');
    // Route::get('/add-to-cart/{id}', 'User\PizzaController@add')->name('user.pizza.add');
    // Route::get('/reduce/{id}', 'User\PizzaController@reduce')->name('user.pizza.reduce');
    // Route::get('/increase/{id}', 'User\PizzaController@increase')->name('user.pizza.increase');
    // Route::get('/shoppingCart', 'User\PizzaController@cart')->name('user.pizza.cart');
    // Route::get('/clear', 'User\PizzaController@clear')->name('user.pizza.clear');
    // Route::post('/home', 'User\PizzaController@store')->name('user.pizza.store');
    // Route::get('/profile', 'User\PizzaController@profile')->name('user.pizza.profile');
    // Route::get('/change_password', 'User\ChangePasswordController@resetForm')->name('user.pizza.change_password');
    // Route::patch('/change_password', 'USer\ChangePasswordController@changePassword')->name('user.pizza.change_password');
});

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
