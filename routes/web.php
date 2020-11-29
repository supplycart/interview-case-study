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

Auth::routes(['verify' => true]);

Route::name('product.')->group(function () {
    Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('index');
    Route::get('detail/{product}', [\App\Http\Controllers\ProductController::class, 'view'])->name('view');
});

Route::name('cart.')->prefix('cart')->group(function () {
    Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('index');
    Route::post('add/{product}', [\App\Http\Controllers\CartController::class, 'add'])->name('add');
    Route::delete('remove/{cart}', [\App\Http\Controllers\CartController::class, 'remove'])->name('remove');
    Route::post('checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('checkout')->middleware(['auth', 'verified']);
});

Route::name('order.')->prefix('order')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [\App\Http\Controllers\OrderController::class, 'index'])->name('index');
    Route::get('detail/{order}', [\App\Http\Controllers\OrderController::class, 'view'])->name('view');
});


Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

