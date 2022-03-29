<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use App\Models\Order;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            switch (explode(".", $request->route()->getName())[0]) {
                case "cart":
                    $cart = Cart::where("id", $request->route()->parameter("cart_id"))->firstOrFail();
                    if ($cart->user()->id != Auth::id()) {
                        return response([
                            "code" => "UNAUTHENTICATED - CART",
                            "message" => "This user is not authenticated to manage this cart"
                        ], 401);
                    }
                    break;
                case "order":
                    $order = Order::where("id", $request->route()->parameter("order_id"))->firstOrFail();
                    if ($order->user()->id != Auth::id()) {
                        return response([
                            "code" => "UNAUTHENTICATED - ORDER",
                            "message" => "This user is not authenticated to view this order!"
                        ], 401);
                    }
                    break;
            }
        } catch (\Exception $e) {
            return response([
                "code" => "IA - NOT FOUND",
                "message" => "Resource not found!"
            ], 404);
        }
        return $next($request);
    }
}
