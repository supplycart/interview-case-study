<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart;

        return inertia('Cart/Listing', [
            'cart' => $cart,
            'items' => $cart ? $cart->items()->with('product')->get() : [],
        ]);
    }

    /**
     * Add to cart
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'slug' => 'required|exists:products,slug',
        ]);

        $product = Product::where('slug', $request->slug)->firstOrFail();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->addToCart($product);
    }

    /**
     * Remove from cart
     */
    public function destroy(Request $request, Product $product)
    {
        $this->validate($request, [
            'slug' => 'required|exists:products,slug',
        ]);

        $product = Product::where('slug', $request->slug)->firstOrFail();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->removeFromCart($product);
    }

    public function checkout(Request $request)
    {

        $this->validate($request, [
            'billing_name' => 'required',
            'billing_email' => 'required|email',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_country' => 'required',
            'billing_postalcode' => 'required',
        ]);

        DB::beginTransaction();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $order = Order::create([
            'user_id' => $user->id,
            // Billing information
            'billing_name' => $request->billing_name,
            'billing_address' => $request->billing_address,
            'billing_city' => $request->billing_city,
            'billing_country' => $request->billing_country,
            'billing_postalcode' => $request->billing_postalcode,
            // // Shipping information
            // 'shipping_name' => $request->shipping_name,
            // 'shipping_address' => $request->shipping_address,
            // 'shipping_city' => $request->shipping_city,
            // 'shipping_country' => $request->shipping_country,
            // 'shipping_postalcode' => $request->shipping_postalcode,
        ]);

        // Copy products to order items with cart item quantity
        $user->cart->items()->each(function ($item) use ($order) {
            $order->items()->create([
                // product information
                'product_id' => $item->product_id,
                'name' => $item->product->name,
                'price' => $item->product->price,
                'image' => $item->product->image,
                'slug' => $item->product->slug,
                'description' => $item->product->description,

                // cart item information
                'quantity' => $item->quantity,
            ]);
        });

        $user->cart->items()->delete();

        DB::commit();

        activity()
            ->causedBy($user)
            ->withProperties([
                'cart' => $user->cart,
                'cart_items' => $user->cart->items
            ])
            ->log('User made an order.');

        return redirect()->route('orders.show', $order);
    }

}
