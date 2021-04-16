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
