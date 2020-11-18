<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->getProducts();
        return view('shop', compact('products'));
    }

    public function addToCart($id)
    {
        $product = Products::find($id);

        if(!$product) {
            abort(404);
        }

        $cart = session()->has('cart') ? session()->get('cart') : [];

        if(isset($cart[$id])){
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1
            ];
        }
        session()->put('cart', $cart);
        session()->flash('message', $product->title.' added to cart.');
        return response()->json($cart);
    }

    public function getProducts()
    {
        return Products::limit(30)->get();
    }
}
