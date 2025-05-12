<?php

use App\Http\Controllers\API;
use Illuminate\Support\Facades\Route;

Route::post('register', [Api\AuthController::class, 'register']);
Route::post('login', [Api\AuthController::class, 'login']);
Route::get('logout', [Api\AuthController::class, 'logout'])
    ->middleware('auth:api');
Route::get('verify-email/{id}/{hash}', [Api\AuthController::class, 'verifyEmail'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('users', Api\UserController::class)->only(['index', 'show']);
});
