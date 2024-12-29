<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Product/Index', [
            'products' => Product::select('id', 'name')
                ->with(['variations' => function ($query) {
                    $query->select('id', 'product_id', 'name', 'price', 'image')
                        ->limit(1);
                }])->paginate(12),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('Product/Show', [
            'product' => $product->load('variations'),
        ]);
    }
}
