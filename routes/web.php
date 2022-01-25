<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('login');
})->name("login");

Auth::routes();

Route::get('/home', [App\Http\Controllers\ProductController::class, 'index'])->name('home');
Route::post('/addToCart', [App\Http\Controllers\CartController::class, 'add'])->name('addToCart');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('/placeOrder', [App\Http\Controllers\CartController::class, 'placeOrder'])->name('cartPlaceOrder');
Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('orderHistory');
