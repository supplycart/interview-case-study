<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view("welcome", compact('products'));
    }
}
