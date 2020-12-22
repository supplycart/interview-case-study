<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CartRequest;
use App\Models\Cart;
use DB;
use Validator;

class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::query()->with('product.brand')->where('user_id', auth()->user()->id)->get();

        return response()->json(
            [
                "status"  => true,
                "data"    => $carts,
                "message" => "success",
            ]
        );
    }

    public function store(CartRequest $request)
    {
        $data = $request->data();

        $cart      = Cart::query()->firstOrNew($data);
        $cart->qty = $request->quantity ?? $cart->qty + 1;
        $cart->save();

        activity()->withProperties(['user_agent' => $request->header('User-Agent')])->log('add a product to cart');

        $carts = Cart::query()->with('product.brand')->where('user_id', auth()->user()->id)->get();

        return response()->json(["status" => true, 'data' => $carts, "message" => "Data retrieved"], 200);
    }

    public function sync()
    {
        foreach (request()->all() as $cart) {
            Cart::query()->updateOrCreate(['product_id' => $cart['product_id'], 'user_id' => auth()->user()->id], ['qty' => $cart['qty']]);
        }

        $carts = Cart::query()->where('user_id', auth()->user()->id)->get();

        return response()->json(["status" => true, 'data' => $carts, "message" => "Data retrieved"], 200);
    }

}
