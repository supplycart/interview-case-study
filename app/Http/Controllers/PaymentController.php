<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\StoreRequest;
use App\Models\Activity;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function charge(StoreRequest $request): RedirectResponse
    {
        try {
            $stripeCharge = $request->user()->charge(
                $request->amount, $request->method, [
                    'currency' => 'myr',
                ]
            );

            DB::transaction(function () use ($request, $stripeCharge) {
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total' => $request->amount,
                    'charge_id' => $stripeCharge->latest_charge
                ]);

                $cartItems = CartItem::select('product_id', 'quantity')->where('cart_id', $request->cart)->get();

                foreach ($cartItems as $key => $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity
                    ]);
                }
                $cart = Cart::where('id', $request->cart);
                $cart->delete();

                Activity::create([
                    'user_id' => Auth::id(),
                    'action' => 'store',
                    'module' => 'payment',
                    'description' => 'cart ID '.$request->cart.' paid and added to order',
                ]);
            });

            return Redirect::to('/orders')->with('success', 'Checkout success and order added.');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return Redirect::to('/carts')->with('error', 'Something went wrong.');
        }
    }
}
