<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\PurchaseOrder;
use App\Models\Product;


class CartController extends Controller
{
    function viewCart()
    {
        $currentUserCart = Cart::where('id_user', Auth::user()->id)
                               ->get();

        if(count($currentUserCart) > 0) //User has existing carts, so get a cart that has not been checked out yet.
        {
            $validPO = PurchaseOrder::whereIn('id_cart', $currentUserCart->pluck('id'))
                               ->get();
            $cart = $currentUserCart->whereNotIn('id', $validPO->pluck('id_cart'))->first();

            if($cart != NULL)
            {
                $cartItems = CartItem::where('id_cart', $cart->id)
                                     ->get();

                $product = Product::whereIn('id', $cartItems->pluck('id_product'))
                                  ->get()
                                  ->keyBy('id');
                return view('cart.viewCart', compact('cart', 'cartItems', 'product'));

            }
        }
        $cartItems = $product = [];
        return view('cart.viewCart', compact('cart', 'cartItems', 'product'));

    }

    function addToCart(Request $request)
    {
        $currentUserCart = Cart::where('id_user', Auth::user()->id)
                               ->get();

        $products = Product::get()
                           ->keyBy('id');
        if(count($currentUserCart) > 0) //User has existing carts, so get a cart that has not been checked out yet.
        {
            $validPO = PurchaseOrder::whereIn('id_cart', $currentUserCart->pluck('id'))
                               ->get();
            $cart = $currentUserCart->whereNotIn('id', $validPO->pluck('id_cart'))->first();
            if($cart == NULL) //All carts have associated PO == create new cart
            {
                $cart = new Cart();
                $cart->id_user = Auth::user()->id;
                $cart->save();
            }
        }
        else //User has no carts
        {
            $cart = new Cart();
            $cart->id_user = Auth::user()->id;
            $cart->save();
        }

        foreach($request->qty as $key => $quantities)
        {
            $cartItem = new CartItem();

            $cartItem->id_cart = $cart->id;
            $cartItem->id_product = $key;
            $cartItem->quantity = $quantities;
            $cartItem->price = $quantities * $products[$key]->product_price;

            $cartItem->save();
        }
        return redirect(route("home"))
            ->with("success", count($request->qty)." items added to Cart!");
    }

    function createOrder(Request $request)
    {
        $cartItems = CartItem::whereIn('id', array_keys($request->qty))
                             ->get();
        $products = Product::whereIn('id', $cartItems->pluck('id_product'))
                           ->get()
                           ->keyBy('id');
        $sum = 0;
        foreach($cartItems as $ci)
        {
            $sum += $ci->quantity * $products[$ci->id_product]->product_price;
        }
        $purchaseOrder = new PurchaseOrder();

        $purchaseOrder->id_cart = $request->cart;
        $purchaseOrder->status = 0; //0: New PO, 1: PO Sent, 2: PO Complete, 3: PO Cancelled
        $purchaseOrder->total_cost = $sum;

        $purchaseOrder->save();

        return redirect(route("home"))
                ->with("success", "Purchase Order Created!");
    }
}
