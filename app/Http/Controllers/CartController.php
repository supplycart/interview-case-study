<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        return response(Auth::user()->getCart(), 200);
    }

    public function create(CartRequest $request) {
        $input = $request->all();
        $input["user_id"] = Auth::id();
        $input["status"] = 0;
        $res = Cart::create($input);
        if (!$res) {
            return response(["message" => "The product is added to cart already"], 400);
        }
        return response($res, 201);
    }

    public function update(Request $request) {
        try {
            foreach($request->carts as $cart) {
                Cart::where("id", $cart['id'])->firstOrFail()->update(["quantity" => $cart["quantity"]]);
            }
        } catch (\Exception $e) {
            return response([
                "code" => "CC001",
                "message" => "Item not found",
            ], 404);
        }
        return $this->index();
    }

    public function delete(int $id) {
        try {
            Cart::where("id", $id)->firstOrFail()->delete();
        } catch (\Exception $e) {
            return response([
                "code" => "CC002",
                "message" => "Item not found",
            ], 404);
        }
        return $this->index();
    }

    public function voucher($voucherId) {
        try {
            return response(Voucher::where("code", $voucherId)->firstOrFail(), 200);
        } catch(\Exception $e) {
            return response([
                "code" => "CC003",
                "message" => "Voucher not found"
            ], 404);
        }
    }
}
