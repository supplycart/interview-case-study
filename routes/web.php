<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/{any}', function () {
//     return view('app');
// })->where('any', '.*');

Route::get('/users', function () {
    return User::all();
});
