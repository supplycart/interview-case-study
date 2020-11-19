<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubmitController;
use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Api\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', 'Auth\LoginController@authUser');   //old way
// Route::get('/place-order', 'Order\OrderController@createOrder');                    //old way

Route::group(['middleware'=> 'auth:sanctum'], function(){

    Route::get('/user', [LoginController::class, 'authUser']);
    Route::post('/submit-order', [SubmitController::class, 'update']);


});

Route::post('/submit-order', [SubmitController::class, 'update']);
// Route::get('/populate/order', [OrderController::class, 'orderHistory']);

