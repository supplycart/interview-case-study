<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CartRequest;
use App\Http\Requests\Api\ProductFilterRequest;
use App\Http\Resources\ProductsCollection;
use App\Models\Cart;
use App\Models\Product;
use DB;
use Validator;

class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::query()->where('user_id', auth()->user()->id)->get();

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

        $carts = Cart::query()->where('user_id', auth()->user()->id)->get();

        return response()->json(["status" => true, 'data' => $carts, "message" => "Data retrieved"], 200);
    }

}
