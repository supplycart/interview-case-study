<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\AuthController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\Site\AccountController;
use App\Http\Controllers\Site\MailController;

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
require 'api.php';

//Route::get('/{any}', [SiteController::class, 'index'])->where('any', '.*');

Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('site.login');
Route::post('login', [AuthController::class, 'login'])->name('site.login.post');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('site.register');
Route::post('register', [AuthController::class, 'register'])->name('site.register.post');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/add/cart', [ProductController::class, 'addToCart'])->name('product.add.cart');
Route::get('/cart', [CartController::class, 'getCart'])->name('checkout.cart');
Route::get('/cart/item/{id}/remove', [CartController::class, 'removeItem'])->name('checkout.cart.remove');

Route::group(['middleware' => ['auth']], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('site.logout');
    Route::get('/checkout', [CheckoutController::class, 'getCheckout'])->name('checkout.index');
    Route::post('/checkout/order', [CheckoutController::class, 'placeOrder'])->name('checkout.place.order');
    Route::get('checkout/payment/complete', [CheckoutController::class, 'complete'])->name('checkout.payment.complete');
    Route::get('orders', [AccountController::class, 'getOrders'])->name('site.orders');
    Route::get('/email/verify', [MailController::class, 'mailVerificationNotice'])->name('verification.notice');
});

Route::group(['middleware' => ['auth', 'signed']], function () {
    Route::get('/email/verify/{id}/{hash}', [MailController::class, 'verifyMail'])->name('verification.verify');

});

Route::group(['middleware' => ['auth', 'throttle:6,1']], function () {
    Route::post('/email/verification-notification', [MailController::class, 'resendMail'])->name('verification.resend');
});




