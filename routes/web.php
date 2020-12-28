<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ProductController;
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

require __DIR__.'/auth.php';
