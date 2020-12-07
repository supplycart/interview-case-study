<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->has('q') ? $request->q : "";

        $categoryId = $request->has('category') ? $request->category : '';

        $brandId = $request->has('brand') ? $request->brand : '';

        return ProductResource::collection(Product::index($search, $categoryId, $brandId)->paginate(20));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
