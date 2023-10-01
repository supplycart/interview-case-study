<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function getAttributeList()
    {
        return Attribute::all();
    }

    public function getProductList($attr_id = null)
    {
        $product = Product::with('productAttributes.attribute');

        if (!is_null($attr_id)) {
            $product->whereHas('productAttributes', function ($query) use ($attr_id) {
                $query->where('attribute_id', $attr_id);
            });
        }
        return $product->get();
    }

    public function addCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product_id = $request->product_id;

        $cartItem = Auth::user()->carts()->firstOrNew(['product_id' => $product_id]);

        $cartItem->quantity++;
        $cartItem->save();

        activity()->log("Added $product_id into cart");
    }

    public function retrieveCart()
    {
        $cart = Auth::user()->carts;

        $total = 0;

        foreach ($cart as $item) {
            $total += $item->quantity * $item->product->price;
        }

        $total = number_format((float) (round($total * 2, 1) / 2), 2, '.', '');

        return compact('cart', 'total');
    }

    public function checkoutCart()
    {
        $cartDetail = $this->retrieveCart();

        Auth::user()->orders()->create([
            'snapshot' => json_encode($cartDetail['cart']),
            'total_price' => $cartDetail['total']
        ]);

        Auth::user()->carts()->delete();

        activity()->log("Checkout cart, RM" . $cartDetail['total']);
    }

    public function retrieveOrder()
    {
        $orders = Auth::user()->orders;

        return compact('orders');
    }
}
