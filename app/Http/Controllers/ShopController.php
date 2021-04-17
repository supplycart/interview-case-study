<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        return Inertia::render('Shop', [
            'categories' => $categories
        ]);
    }

    public function searchProduct(Request $request)
    {
        $validated_data = $request->validate([
            'keyword' => 'required'
        ]);

        $products = Product::where('name', 'like', "%{$validated_data['keyword']}%")
            ->whereHas('productPrice')
            ->with('rankedProductPrice')
            ->get();

        return response()->json($products);
    }

    public function getProductsByCategory(Request $request)
    {
        $validated_data = $request->validate([
            'category_id' => 'required'
        ]);

        $products = Product::where('category_id', $validated_data['category_id'])
            ->whereHas('productPrice')
            ->with('rankedProductPrice')
            ->get();

        return response()->json($products);
    }
}
