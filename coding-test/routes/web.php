<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {return view('login');});
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/register', function () {return view('register');});
Route::post('/register', [UserController::class, 'register'])->name('register');