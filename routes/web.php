<?php

Auth::routes();

Route::get('/logout-manual', function () {
   request()->session()->invalidate();
});

Route::get('/{any}', 'AppController@index')->where('any', '.*');
