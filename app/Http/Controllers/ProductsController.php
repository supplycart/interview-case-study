<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        
        // return $products[0];
        return view('products.index')->with('products', $products);
    }     
}
