<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CheckoutRequest;
use App\Http\Requests\Api\ProductFilterRequest;
use App\Http\Resources\OrdersCollection;
use App\Http\Resources\ProductsCollection;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use DB;
use Exception;
use Validator;

class OrderController extends Controller
{

    public function index()
    {
        $carts = Order::query()->with('orderProducts.product.brand')->where('user_id', auth()->user()->id)->paginate(5);

        return response()->json(
            new OrdersCollection($carts)
        );
    }

    public function store(CheckoutRequest $request)
    {
        $cart_ids = collect($request->data())->pluck('product_id');

        DB::beginTransaction();
        try {
            $carts = Cart::query()->whereIn('product_id', $cart_ids)->where('user_id', $request->user()->id)->get();

            $grand_total = $carts->sum(
                function ($t) {
                    return $t->product->price * $t->qty;
                }
            );
            $orderData   = [
                'user_id' => $request->user()->id,
                'amount'  => $grand_total,
            ];
            $order       = Order::create($orderData);
            foreach ($carts as $cart) {
                $orderProductData = [
                    'product_id' => $cart->product_id,
                    'qty'        => $cart->qty,
                    'price'      => $cart->product->price,
                ];
                $order->orderProducts()->create($orderProductData);

                $cart->product->stock -= $cart->qty;
                $cart->product->save();
                $cart->delete();
            }

            DB::commit();
        } catch (Exception $e) {
            return response()->json(["status" => false, 'data' => $e, "message" => "Data retrieved"], 200);

            DB::rollback();
        }

        return response()->json(["status" => true, 'data' => $grand_total, "message" => "Data retrieved"], 200);
    }

}
