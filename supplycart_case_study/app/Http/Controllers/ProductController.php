<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{

    protected ProductRepositoryInterface $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'brand_id', 'category_id']);

        return Inertia::render('Product', [
            'products' => $this->productRepo->paginateWithRelations(9, $filters),
            'filters' => $filters,
            'brands' => \App\Models\Brand::select('id', 'name')->get(),
            'categories' => \App\Models\Category::select('id', 'name')->get(),
        ]);
    }


}
