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
    Route::prefix('auth')->group(function(){
        Route::post('/login', 'AuthController@login');
        Route::post('/register', 'AuthController@createUser');
        Route::post('/forgetPassword', 'AuthController@forgetPassword');
        Route::post('/passwordLink', 'AuthController@getPasswordLink')->name('password_link');

        Route::middleware(['auth.user'])->group(function(){
            Route::post('/update/{id}', 'AuthController@updateUser');
            Route::get('/get/{id}', 'AuthController@getUser');
            Route::get('/logout', 'AuthController@logout');
        });
    });

    Route::prefix('admin')->group(function(){
        Route::post('/login', 'AdminController@login');
        Route::post('/create', 'AdminController@createAdmin');
        Route::post('/resetPassword/{id}', 'AdminController@resetAdminPassword');

        Route::middleware(['auth.admin'])->group(function(){
            Route::post('/update/{id}', 'AdminController@updateAdmin');
            Route::get('/get/{id}', 'AdminController@getAdmin');
            Route::get('/logout', 'AdminController@logout');
        });
    });

    Route::prefix('product')->group(function(){
        Route::get('/list',  'ProductController@getProductList');
        Route::get('/detail/{id}', 'ProductController@getProductDetail');
        Route::get('/category/{category_id}', 'ProductController@getProductInCategory');
        Route::middleware(['auth.admin'])->group(function(){
            Route::post('/add', 'ProductController@addProduct');
            Route::delete('/delete/{id}', 'ProductController@removeProduct');
            Route::post('/update/{id}', 'ProductController@updateProduct');
        });
    });

    Route::prefix('sales_order')->group(function(){
        Route::get('/getOrder/{user_id}', 'OrderController@getOrderList');
        Route::post('/checkout', 'OrderController@checkout');
    });

    Route::get('/payOrder/{order_id}', 'OrderController@payOrder');
    Route::get('/payment/process', 'PaymentController@processPayment')->name('payment.process');

    Route::get('/getCart/{user_id}', 'CartController@getCart');
    Route::post('/addToCart/{product_id}', 'CartController@addToCart');
    

    Route::get('/getCategory', 'CategoryController@getCategory');
});
