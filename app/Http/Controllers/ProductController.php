<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $id)
    {
        
        $product = Product::find($id);

        // Find the category using the product's category ID
        $category = Category::find($product->category);

        // Return the Product view with the product and category name
        return Inertia::render('Product', [
            'product' => Product::find($id),
            'category_name' => $category->name,
        ]);
    }

}
