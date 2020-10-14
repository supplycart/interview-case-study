<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Auth::user()->cart;
        if (is_null($cart)) {
            $cart = Cart::create(['user_id' => Auth::user()->id]);
        }
        $cart['items'] = $cart->items;

        return response($cart, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function additem(Request $request)
    {
        $cart_item = CartItem::create([
            'cart_id' => $request->cart_id,
            'product_id' => $request->id,
            'product_name' => $request->name,
            'product_type' => $request->type,
            'product_price' =>$request->price
        ]);
        return response()->json([$cart_item], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Request $request) {
        $order = Order::create(['user_id' => $request->user_id]);
        $order->items = [];
        foreach ($request->items as $item) {
            $created_item = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'product_type' => $item['product_type'],
                'product_price' => $item['product_price']
            ]);
        }

        foreach ($request->items as $item) {
            CartItem::find($item['id'])->delete();
        }

        return response()->json([$order], 200);
    }

    /**
     *
     */
    public function order() {
        $orders = Auth::user()->orders;
        return response()->json([$orders], 200);
    }


}
