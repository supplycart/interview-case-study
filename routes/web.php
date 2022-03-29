<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/login', function () {
    return view('app',);
})->name("login");

Route::get('/register', function () {
    return view('app');
})->name("register");

Route::group( ['middleware' => 'auth' ], function() {
    Route::get('/', function () {
        return view('app');
    });

    Route::get('/{catchall?}', function () {
        return response()->view('app');
    })->where('catchall', '(.*)');
});
