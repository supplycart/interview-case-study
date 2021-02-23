<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/item/create', [App\Http\Controllers\ItemController::class, 'create']);
Route::post('/item', [App\Http\Controllers\ItemController::class, 'store']);
