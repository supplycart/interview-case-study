<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;

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

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


Route::get('/', HomeComponent::class);

Route::get('/shop', ShopComponent::class);

// Route::get('/cart', CartComponent::class);
Route::get('/cart/add/{$product_id}', 'App\Http\Controllers\CartController@addProduct');

Route::get('/checkout', CheckoutComponent::class);

// user and customer route
Route::middleware(['auth:sanctum','verified'])->group(function(){
	Route::get('/user/dashboard',UserDashboardComponent::class)->name('user.dashboard');
});

// for admin route
Route::middleware(['auth:sanctum','verified','authadmin'])->group(function(){
	Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
});

Route::get('/brand/{id}', 'App\Http\Controllers\BrandController@getBrand')->name('brand.get');

Route::get('/category/{id}', 'App\Http\Controllers\CategoryController@getCategory')->name('category.get');
