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
Route::post('/register', [\App\Http\Controllers\UserController::class, 'store']);

// route everything with /product to ProductController
Route::resource('product', \App\Http\Controllers\ProductController::class);

Route::post('/login', function () {
    return 'welcome';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
