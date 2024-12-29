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
        return Inertia::render('Products/Index', [
            'products' => Product::select('id', 'name')
                ->with(['variations' => function ($query) {
                    $query->select('id', 'product_id', 'name', 'price', 'image')
                        ->limit(1);
                }])->paginate(12),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('Products/Show', [
            'product' => $product->load('variations'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
