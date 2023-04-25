<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Product/Listing', [
            'products' => Product::with('categories')->get(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['categories', 'attributes.options']);
        return Inertia::render('Product/Show', [
            'product' => $product,
        ]);
    }

}
