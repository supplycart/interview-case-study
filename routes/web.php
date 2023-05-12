<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Activity;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        $data['products'] = Product::get();
        return Inertia::render('Dashboard', $data);
    })->name('dashboard');

    Route::get('/activity', function () {
        $data['activities'] = Activity::with('user:id,name')->get();
        return Inertia::render('Activity', $data);
    })->name('activity');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/stripe/checkout/pay', [PaymentController::class, 'charge'])->name('stripe.pay');

    Route::resources([
        'products' => ProductController::class,
        'orders' => OrderController::class,
        'carts' => CartController::class,
        'cartitems' => CartItemController::class,
    ]);
});

require __DIR__.'/auth.php';
