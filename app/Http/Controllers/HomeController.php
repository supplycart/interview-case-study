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
        $category = "";

        $products = Product::where('status', 'active');

        if(!is_null($request->category)) {
            $category = $request->category;
            $products = $products->where('category', $category);
        }

        $products = $products->get();

        return view('home', compact('products', 'category'));
    }
}
