<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

Auth::routes([
    'reset' => false,
    'verify' => false,
]);

Route::get('storage/{filename}', function ($filename) {
    return Image::make(storage_path('app/uploads/' . $filename))->response();
});

Route::group(['middleware' => 'auth'], function () {
    Route::view('/', 'home');
    Route::view('/cart', 'cart');

    Route::get('/api/home', [Api\HomeController::class, 'index']);
    Route::get('/api/cart', [Api\CartController::class, 'index']);

    Route::post('/cart', [Api\CartController::class, 'store']);
    Route::patch('/cart/{item}', [Api\CartController::class, 'update']);
    Route::delete('/cart/{item}', [Api\CartController::class, 'delete']);

    Route::get('/item/create', [Api\ItemController::class, 'create']);
    Route::post('/item', [Api\ItemController::class, 'store']);

    Route::get('/order', [Api\OrderController::class, 'index']);
    Route::post('/order', [Api\OrderController::class, 'store']);
});
