<?php

namespace App\Http\Controllers;

use App\Helpers\MasterLookupHelper;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategories = $request->string('categories')->ltrim(',')->rtrim(',')->explode(',');
        $selectedBrands     = $request->string('brands')->ltrim(',')->rtrim(',')->explode(',');
        $activeStatus       = MasterLookupHelper::getStatusID('product_status', 'active');

        $products = Product::query()
            ->with(['images', 'categories', 'brand'])
            ->where('status_id', $activeStatus)
            ->when(
                $request->input('search'),
                fn (Builder $query, $search) => $query->where('name', 'like', "%$search%")
            )
            ->when(
                count($selectedCategories) > 0 && !empty($selectedCategories[0]),
                fn (Builder $query) => $query
                    ->whereHas(
                        'categories',
                        fn (Builder $query) => $query->whereIn('category_id', $selectedCategories)
                    )
            )
            ->when(
                count($selectedBrands) > 0 && !empty($selectedBrands[0]),
                fn (Builder $query) => $query->whereIn('brand_id', $selectedBrands)
            )
            ->latest('id')
            ->paginate(12, ['*'], 'page', $request->input('page', 1))
            ->withQueryString();

        $brands = \Cache::remember('all_brands', 60 * 60 * 24, function () {
            return Brand::all();
        });

        $categories = \Cache::remember('all_categories', 60 * 60 * 24, function () {
            return Category::all();
        });

        return Inertia::render('Product/Index', [
            'search'             => $request->input('search'),
            'products'           => $products,
            'categories'         => $categories,
            'selectedCategories' => $selectedCategories,
            'brands'             => $brands,
            'selectedBrands'     => $selectedBrands,
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
