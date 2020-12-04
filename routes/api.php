<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OauthController;
use App\Http\Controllers\Api\ProductController;

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

Route::group(['prefix' => 'auth'], function() {
        Route::post('register', [OauthController::class, 'register']);
        Route::post('login', [OauthController::class, 'login']);
});

Route::get('products', [ProductController::class, 'getProducts']);
Route::get('/product/{slug}', [ProductController::class, 'getProductDetail']);
