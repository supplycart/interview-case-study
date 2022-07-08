<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

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

Route::get('/','MovieController@index')->name('movie');

//Movie Module
Route::get('movie','MovieController@index')->name('movie');
Route::post('movie','MovieController@store')->name('movie.create');
Route::patch('movie/{id}','MovieController@update')->name('movie.update');
Route::delete('movie/{id}','MovieController@destroy')->name('movie.delete');

//Actor Module
Route::get('actor','ActorController@index')->name('actor');
Route::post('actor','ActorController@store')->name('actor.create');
Route::patch('actor/{id}','ActorController@update')->name('actor.update');
Route::delete('actor/{id}','ActorController@destroy')->name('actor.delete');

//Producer Module
Route::get('producer','ProducerController@index')->name('producer');
Route::post('producer','ProducerController@store')->name('producer.create');
Route::patch('producer/{id}','ProducerController@update')->name('producer.update');
Route::delete('producer/{id}','ProducerController@destroy')->name('producer.delete');

require __DIR__.'/auth.php';