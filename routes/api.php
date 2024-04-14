<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'api', 'namespace' => 'API'], function()
{   
    Route::group(['prefix' => 'auth'], function(){
        Route::post('/register', 'AuthController@createUser');
        Route::post('/login', 'AuthController@login');
        Route::post('/forgetPassword', 'AuthController@forgetPassword');
        Route::post('/passwordLink', 'AuthController@getPasswordLink')->name('password_link');
    });

    Route::group(['prefix' => 'admin'], function(){
        Route::post('/create', 'AdminController@createAdmin');
        Route::post('/login', 'AdminController@login');
        Route::post('/update/{id}', 'AdminController@updateAdmin');
        Route::post('/resetPassword/{id}', 'AdminController@resetAdminPassword');
        Route::get('/get/{id}', 'AdminController@getAdmin');
    });

    Route::group(['prefix' => 'product'], function(){
        Route::get('/list',  'ProductController@getProductList');
        Route::get('/detail/{id}', 'ProductController@getProductDetail');
        Route::post('/add',  'ProductController@addProduct');
        Route::post('/remove/id', 'ProductController@removeProduct');
        Route::post('/update/{id}', 'ProductController@updateProduct');
        Route::get('/category/{category_id}', 'ProductController@getProductInCategory');
    });

    Route::get('/getOrder/{user_id}', 'OrderController@getOrderList');
    Route::get('/payOrder/{order_id}', 'PaymentController@checkout');
    Route::get('/payment/process', 'PaymentController@processPayment')->name('payment.process');

    Route::get('/getCart/{user_id}', 'CartController@getCart');
    Route::post('/addToCart/{product_id}', 'CartController@addToCart');
    Route::post('/checkout', 'CartController@checkout');

    Route::get('/getCategory', 'CategoryController@getCategory');
});
