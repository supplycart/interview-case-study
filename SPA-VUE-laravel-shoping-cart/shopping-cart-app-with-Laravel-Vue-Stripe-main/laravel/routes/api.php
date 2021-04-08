<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;

Route::get('/products', [ProductController::class, 'index']);
route::post('/purchase', [UserController::class, 'Purchase']);
