<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Route::get('/home', function() {
//    return view('layouts.main');
//})->middleware('auth');

Route::get('{any}', function () {
    return view('layouts.main');
})->where('any', '.*')
    ->middleware('auth:sanctum');


