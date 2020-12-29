<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\CartController;
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

Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth'])->name('admin');

Route::get('/app', [ProductController::class, 'index'])->middleware(['auth'])->name('app');
Route::get('/app/product/{product}', [ProductController::class, 'show'])->middleware(['auth'])->name('product-detail');
Route::post('/app/product/{product}/cart', [CartController::class, 'store'])->middleware(['auth'])->name('add-product-to-cart');
Route::delete('/app/product/{product}/cart/remove', [CartController::class, 'destroy'])->middleware(['auth'])->name('remove-product-from-cart');
Route::get('/cart', [CartController::class, 'index'])->middleware(['auth'])->name('cart');

require __DIR__.'/auth.php';
