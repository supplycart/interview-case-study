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
        Route::get('/logout/{id}', 'AuthController@logout');
    });

    Route::prefix('admin')->group(function(){
        Route::post('/login', 'AdminController@login');

        Route::middleware(['auth.admin'])->group(function(){
            Route::post('/create', 'AdminController@createAdmin');
            Route::post('/update/{id}', 'AdminController@updateAdmin');
            Route::post('/resetPassword/{id}', 'AdminController@resetAdminPassword');
            Route::get('/get/{id}', 'AdminController@getAdmin');
            Route::get('/logout/{id}', 'AdminController@logout');
        });
    });

    Route::prefix('product')->group(function(){
        Route::get('/list',  'ProductController@getProductList');
        Route::get('/detail/{id}', 'ProductController@getProductDetail');
        Route::get('/category/{category_id}', 'ProductController@getProductInCategory');

        Route::middleware(['auth.admin'])->group(function(){
            Route::post('/add', 'ProductController@addProduct');
            Route::post('/remove/id', 'ProductController@removeProduct');
            Route::post('/update/{id}', 'ProductController@updateProduct');
        });
    });

    Route::get('/getOrder/{user_id}', 'OrderController@getOrderList');
    Route::get('/payOrder/{order_id}', 'OrderController@payOrder');//
    Route::get('/payment/process', 'PaymentController@processPayment')->name('payment.process');

    Route::get('/getCart/{user_id}', 'CartController@getCart');
    Route::post('/addToCart/{product_id}', 'CartController@addToCart');
    Route::post('/checkout', 'CartController@checkout');

    Route::get('/getCategory', 'CategoryController@getCategory');
});
