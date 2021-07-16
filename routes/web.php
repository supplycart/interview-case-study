<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/custom-signin', [AuthController::class, 'createSignin'])->name('signin.custom');


Route::get('/register', [AuthController::class, 'signup'])->name('register');
Route::post('/create-user', [AuthController::class, 'customSignup'])->name('user.registration');


Route::get('/dashboard', [AuthController::class, 'dashboardView'])->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Shop

Route::get('/shop', [ProductsController::class, 'index'])->name('shopindex');
Route::get('cart', [ProductsController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductsController::class, 'addToCart'])->name('addToCart');

Route::patch('update-cart', [ProductsController::class, 'update'])->name('update');
Route::delete('remove-from-cart', [ProductsController::class, 'remove'])->name('remove-from-cart');

// Orders
Route::get('/orders', [OrderController::class, 'index'])->name('ordersindex');
Route::get('checkout', [ProductsController::class, 'checkout'])->name('checkout');