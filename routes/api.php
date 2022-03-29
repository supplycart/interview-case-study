<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/login", [AuthController::class, "login"])->name("user.login");
Route::post("/user", [UserController::class, "store"])->name("user.register");
Route::get("/auth", [AuthController::class, "authenticated"])->name("user.authenticated");

Route::middleware("auth")->group(function() {
    Route::post("/user/upgrade", [UserController::class, "upgrade"])->name("user.upgrade");

    Route::get("/logout", [AuthController::class, "logout"])->name("user.logout");
    Route::get("/histories", [UserController::class, "histories"])->name("user.history");

    Route::get("/products", [ProductController::class, "index"])->name("product.index");

    Route::get("/cats", [CategoryController::class, "index"])->name("cats.index");

    Route::get("/voucher/{voucher_id}", [CartController::class, "voucher"])->name("voucher.get");

    Route::post("/cart", [CartController::class, "create"])->name("cart.create");
    Route::get("/carts", [CartController::class, "index"])->name("cart.index");
    Route::post("/cart/update", [CartController::class, "update"])->name("cart.update");
    Route::delete("/cart/{cart_id}", [CartController::class, "delete"])->middleware("is.auth")->name("cart.update");

    Route::post("/order", [OrderController::class, "store"])->name("order.store");
    Route::get("/orders", [OrderController::class, "index"])->name("order.index");
    Route::get("/order/{order_id}", [OrderController::class, "show"])->name("order.show")->middleware("is.auth");
});


