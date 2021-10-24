<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
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
    return redirect()->route('dashboard');
});

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login-custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register-custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard'); 

Route::get('cart/add/{id}', [CartController::class, 'addCart'])->name('add-cart');
Route::get('cart/delete', [CartController::class, 'deleteCart'])->name('delete-cart');
Route::get('cart/item/delete/{id}', [CartController::class, 'deleteItem'])->name('delete-item');
Route::get('cart/view', [CartController::class, 'viewCart'])->name('view-cart');

Route::get('order/add', [OrderController::class, 'add'])->name('add-order');
Route::get('order/view', [OrderController::class, 'index'])->name('view-order');