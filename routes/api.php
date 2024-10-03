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
        Route::get('/category/{category_id?}', 'ProductController@getProductInCategory');
        Route::middleware(['auth.admin'])->group(function(){
            Route::post('/add', 'ProductController@addProduct');
            Route::delete('/delete/{id}', 'ProductController@removeProduct');
            Route::post('/update/{id}', 'ProductController@updateProduct');
        });
    });
    Route::prefix('cart')->middleware(['auth.user'])->group(function(){
        Route::get('/list', 'CartController@getCart');
        Route::post('/addToCart/{product_id}', 'CartController@addToCart');
        Route::delete('remove/{cart_id}', 'CartController@remove');
    });

    Route::prefix('sales_order')->middleware(['auth.user'])->group(function(){
        Route::get('/getOrder/{user_id}', 'OrderController@getOrderList');
        Route::get('/getOrderItem/{order_id}', 'OrderController@getOrderDetail');
        Route::get('/addItem/{user_id}', 'OrderController@addOrderItem');
        Route::post('/checkout', 'OrderController@checkout');

        Route::middleware(['expired_order'])->group(function(){
            Route::get('/payOrder/{order_id}', 'PaymentController@payOrder');
            Route::get('/cancelOrder/{order_id}', 'OrderController@cancelOrder');
        });
    });

    Route::prefix('user')->middleware(['auth.user'])->group(function(){
        Route::get('/getActivity', 'UserController@getActivity');
    });

    Route::get('/getCategory', 'CategoryController@getCategory');

    Route::get('/payment/process', 'PaymentController@processPayment')->name('payment.process');

    Route::prefix('email')->group(function(){
        Route::middleware(['auth.user'])->group(function(){
            Route::get('/verify', function () {
                return view('auth.verify-email');
            })->name('verification.notice');
            Route::post('/verification-notification', function (Request $request) {
                $request->user()->sendEmailVerificationNotification();
            
                return back()->with('message', 'Verification link sent!');
            })->name('verification.send');
        });
    });
});
