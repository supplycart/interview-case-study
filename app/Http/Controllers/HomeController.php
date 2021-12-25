<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $products = Product::where('status', 'active');

        if(!is_null($request->category)) {
            $products = $products->where('category', $request->category);
        }

        $products = $products->get();

        return view('home', compact('products'));
    }
}
