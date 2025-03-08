<?php

use App\Http\Controllers\API\AuthController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [ AuthController::class, 'login' ]);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
