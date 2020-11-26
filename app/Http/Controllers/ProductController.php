<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // get product listing
        $products = Product::active()->paginate(20);

        return view('product.index', compact('products'));
    }

    public function view(Product $product)
    {
        return view('product.detail', compact('product'));
    }
}
