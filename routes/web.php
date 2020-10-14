<?php

Auth::routes(['verify' => true]);

Route::get('/logout-manual', function () {
   request()->session()->invalidate();
})->name('test-logout');

Route::get('/{any}', 'AppController@index')->where('any', '.*')->middleware('verified');
