<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\Order\OrderController;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', [MainController::class, 'mainHome'])->name('dashboard');
    Route::get('/', [MainController::class, 'mainLogin']);

    Route::get('/get/order/history', [OrderController::class, 'viewHistory']);
    Route::post('/place-order', [OrderController::class, 'createOrder']);
    Route::get('/response/order/{id}', [OrderController::class, 'successOrder']);
    Route::get('/populate/order', [OrderController::class, 'orderHistory']);
    Route::post('/get/order-details', [OrderController::class, 'orderDetails']);

});

// Route::get('/place-order', [OrderController::class, 'createOrder']);

// Route::get('/', 'Main\MainController@mainLogin');           //old style
// Route::get('/place/order', 'App\Http\Controllers\Order\OrderController@createOrder');
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'App\Http\Controllers\Main\MainController@mainHome')->name('dashboard');
