<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    function index() : Response {
        $products = Product::with('category')->paginate(8);

        return Inertia::render('Home/Index', [
            'products' => $products,
        ]);
    }
}
