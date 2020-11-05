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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'], [App\Http\Controllers\WelcomeController::class, 'index'])->name('admin');
Route::get('/product', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index']);
Route::resource('product', App\Http\Controllers\ProductController::class);
Route::resource('category', App\Http\Controllers\CategoryController::class);
Route::resource('subcategory', App\Http\Controllers\SubcategoryController::class);


Route::any('{slug}', function(){
    return view('user.home');
});