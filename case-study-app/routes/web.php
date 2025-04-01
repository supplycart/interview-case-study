<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware("auth")->group(function() {
    Route::get('/', [ProductController::class, "index"])->name("home");

    Route::post('/addToCart', [CartController::class, "addToCart"])->name("addToCart");

    Route::get('/viewCart', [CartController::class, "viewCart"])->name('viewCart');

    Route::post('/createOrder', [CartController::class, "createOrder"])->name('createOrder');
});

Route::get('/login', [AuthController::class, "login"])
     ->name("login");

Route::post('/login', [AuthController::class, "loginPost"])
     ->name("login.post");

Route::get('/register', [AuthController::class, "register"])
    ->name("register");

Route::post('/register', [AuthController::class, "registerPost"])
     ->name("register.post");