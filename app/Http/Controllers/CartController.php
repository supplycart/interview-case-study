<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function add($id)
    {
        $product = Product::find($id);

        if(!$product) {
            abort(404);
        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "photo" => $product->photo
                ]
            ];

            session()->put('cart', $cart);
            $htmlCart = view('includes/header_cart')->render();
            return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            $htmlCart = view('includes/header_cart')->render();
            return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->photo
        ];

        session()->put('cart', $cart);
        $htmlCart = view('includes/header_cart')->render();
        return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);

    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);

            $subTotal = $cart[$request->id]['quantity'] * $cart[$request->id]['price'];
            $total = $this->getCartTotal();
            $htmlCart = view('includes/header_cart')->render();
            return response()->json(['msg' => 'Cart updated successfully', 'data' => $htmlCart, 'total' => $total, 'subTotal' => $subTotal]);
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            $total = $this->getCartTotal();
            $htmlCart = view('includes/header_cart')->render();
            return response()->json(['msg' => 'Product removed successfully', 'data' => $htmlCart, 'total' => $total]);
        }
    }

    public static function getQtyTotal()
    {
        $cart = session()->get('cart');
        $total = 0;

        foreach($cart as $id => $details) {
            $total += $details['quantity'];
        }

        return $total;
    }

    /**
     * getCartTotal
     *
     *
     * @return float|int
     */
    private function getCartTotal()
    {
        $total = 0;
        $cart = session()->get('cart');

        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return number_format($total, 2);
    }
}
