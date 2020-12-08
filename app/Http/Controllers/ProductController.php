<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->has('q') ? $request->q : "";

        if ($request->has('category') && $request->category !== null) {
            $categoryId = Category::name($request->category)->first();
            if (!$categoryId instanceof Category) $categoryId = '';
            else $categoryId = $categoryId->id;
        } else $categoryId = '';

        if ($request->has('brand') && $request->brand !== null) {
            $brandId = Brand::name($request->brand)->first();
            if (!$brandId instanceof Brand) $brandId = '';
            else $brandId = $brandId->id;
        } else $brandId = '';

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
