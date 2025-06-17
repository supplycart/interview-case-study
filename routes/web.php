<?php

use App\Livewire\Customer;
use App\Livewire\Admin;
use App\Livewire\CartManagement;
use App\Livewire\OrderList;
use App\Livewire\OrderView;
use App\Livewire\ProductsIndex;
use App\Livewire\Test;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('product', ProductsIndex::class)
    ->middleware(['auth'])
    ->name('product');

Route::get('cart', CartManagement::class)
    ->middleware(['auth'])
    ->name('cart');

Route::get('order', OrderList::class)
    ->middleware(['auth'])
    ->name('order');
   
Route::get('order/view/{orderId}', OrderView::class)
    ->middleware(['auth'])
    ->name('order.view');


require __DIR__.'/auth.php';
