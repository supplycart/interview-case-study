<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RegistrationController;

use App\Http\Controllers\API\User\ProductController as UserProductController;
use App\Http\Controllers\API\User\OrderController as UserOrderController;
use App\Http\Controllers\API\User\CartController as UserCartController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [ RegistrationController::class, 'register' ]);
Route::post('login', [ AuthController::class, 'login' ]);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', [ AuthController::class, 'user' ]);
    Route::post('logout', [ AuthController::class, 'logout' ]);

    // Route::prefix('admin')->group(function () {
    //     Route::get('/users', function () {
    //         // Matches The "/admin/users" URL
    //     });
    // });

    Route::prefix('user')->group(function () {
        // product
        Route::resource('product', UserProductController::class, [
            'only' => [ 'index', 'show']
        ]);

        // cart
        Route::resource('cart', UserCartController::class);

        // order
        Route::resource('order', UserOrderController::class);

    });
});
