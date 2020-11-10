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

Auth::routes(['verify' => true]);
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('home')->middleware('verified');
Route::post('/orders/save', [App\Http\Controllers\OrderController::class, 'store'])->name('store-order');
Route::get('/orders', [App\Http\Controllers\OrderController::class, 'show'])->name('orders');
Route::get('/', function () {
    return redirect('/products');
});


