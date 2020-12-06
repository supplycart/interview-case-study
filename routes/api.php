<?php

use App\Http\Controllers\AddedProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('added-products', AddedProductController::class)
        ->parameters(['added-products' => 'addedProduct']);
    Route::apiResource('orders', OrderController::class);
});
