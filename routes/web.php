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
    return Redirect::route('shop');
});

Route::get('/home', function () {
    return Redirect::route('shop');
})->name('home');

Auth::routes(['verify' => true]);

Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop');

Route::post('/shop/add/{id}', [App\Http\Controllers\ShopController::class, 'addToCart']);