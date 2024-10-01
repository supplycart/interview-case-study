<?php

namespace App\Http\Controllers;

use App\Helpers\MasterLookupHelper;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $activeStatus = MasterLookupHelper::getStatusID('product_status', 'active');

        $products = Product::with('image')
            ->where('status_id', $activeStatus)
            ->when(
                $request->input('search'),
                fn(Builder $query, $search) => $query->where('name', 'like', "%$search%")
            )
            ->latest('id')
            ->simplePaginate(10, ['*'], 'products', $request->input('page', 1));

        return Inertia::render('Product/Index', [
            'products' => $products->items(),
        ]);
    }

    public function show(Product $product)
    {
        $product->load('images', 'categories');

        return Inertia::render('Product/Detail', [
            'product' => $product,
        ]);
    }
}
