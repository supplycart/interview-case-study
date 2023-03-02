<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use Auth;
use DB;

class CartController extends Controller
{
    public function index() {
        $carts = Cart::with('product')->userCart()->get();
        return Inertia::render('Cart/Index', compact('carts'));
    }

    public function checkout() {
        // Get all checkout items
        $data = request()->all();
        $data = collect($data)->pluck('quantity', 'product_id');
        $product_ids = $data->keys();
        $quantities = $data->values();

        $products = Product::with('category', 'brand')->find($product_ids)->keyBy('id')->toArray();

        $order_details = [];
        foreach($data as $product_id => $quantity) {
            $order_details[] = [
                'product_id' => $product_id,
                'product_name' => $products[$product_id]['name'],
                'category_name' => $products[$product_id]['category']['name'],
                'brand_name' => $products[$product_id]['brand']['name'],
                'quantity' => $quantity,
                'price_per_quantity' => $products[$product_id]['price'],
                'discount_per_quantity' => $products[$product_id]['price'] - $products[$product_id]['discounted_price'],
                'total_amount' => $products[$product_id]['price'] * $quantity,
                'total_discount' => ($products[$product_id]['price'] - $products[$product_id]['discounted_price']) * $quantity,
                'total_nett' => $products[$product_id]['discounted_price'] * $quantity
            ];
        }

        $order_details_summary = collect($order_details);

        DB::beginTransaction();

        $order = Auth::user()->orders()->create([
            'total_amount' => $order_details_summary->sum('total_amount'),
            'total_discount' => $order_details_summary->sum('total_discount'),
            'total_nett' => $order_details_summary->sum('total_nett'),
        ]);

        $order->order_details()->createMany($order_details);

        Cart::userCart()->delete();

        DB::commit();
        
        return response('Order has been successfully placed!', 200);
    }

    public function addToCart() {
        $validator = Validator::make(request()->all(), [
            'product_id' => 'required'
        ]);
        if($validator->fails()) {
            return response('Product not found, please try again', 404);
        }

        $validated = $validator->validated();

        $cart = Cart::userCart()
                        ->where('product_id', $validated['product_id'])
                        ->first();

        DB::beginTransaction();
        if($cart) {
            $cart->quantity++;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $validated['product_id'],
                'quantity' => 1
            ]);
        }
        DB::commit();

        return response('Item successfully added to cart!', 200);
    }
}
