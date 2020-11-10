<?php

namespace App\Http\Controllers;

use Supplycart\Products\Products;

class ProductController extends Controller
{

    /**
     * @var Products
     */
    private $product;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Products $product)
    {
        $this->middleware('auth');
        $this->product = $product;
    }

    /**
     * @return \Illuminate\View\View; 
     */
    public function index() : object  
    {
        $products = $this->product->get();
        return view('products' , compact('products'));
    }
}
