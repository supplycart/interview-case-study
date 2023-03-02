<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class ProductController extends Controller
{
    public function index() {
        if (count(request()->all())) {
            return Product::when(request()->selectedBrands, function($query) {
                $query->whereIn('brand_id', request()->selectedBrands);
            })->when(request()->selectedCategories, function($query) {
                $query->whereIn('category_id', request()->selectedCategories);
            })->get();
        }
        return Inertia::render('Product/Index', [
            'products' => Product::all(),
            'brands' => Brand::all(),
            'categories' => Category::all(),
        ]);
    }
}
