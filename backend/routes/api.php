<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

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

// register endpoint
Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);

// login endpoint
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);

// all endpoint inside here require authentication
Route::middleware(['auth:sanctum'])->group(function (){

    // logout endpoint
    Route::post('/logout', [\App\Http\Controllers\UserController::class, 'logout']);

});



// route everything with /product to ProductController
Route::resource('/product', \App\Http\Controllers\ProductController::class);

// route everything with /cart to CartController
Route::resource('/cart', \App\Http\Controllers\CartController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
