<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function list(){
        $product_list = Product::all();

        return view('product.list', compact('product_list'));
    }
}
