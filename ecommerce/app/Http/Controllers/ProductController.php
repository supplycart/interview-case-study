<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Get the view for product dashboard.
     */
    public function dashboard()
    {
        $products = Product::all();
        return view('dashboard', compact('products'));
    }
}
