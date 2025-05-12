<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\IndexRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $query = Product::query()->with(['brand', 'category', 'price']);

        if (isset($validated['search'])) {
            $query->where('name', 'like', "%{$validated['search']}%");
        }

        if (isset($validated['filter']['brand_id'])) {
            $query->where('brand_id', $validated['filter']['brand_id']);
        }

        if (isset($validated['filter']['category_id'])) {
            $query->where('category_id', $validated['filter']['category_id']);
        }

        $data = new ProductCollection($query->paginate($validated['limit'] ?? 10));

        return $this->respond(message: 'Get product list successful.', data: $data);
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
    public function show(Product $product): JsonResponse
    {
        $product->load(['brand', 'category', 'price']);

        return $this->respond(
            message: 'Get product detail successful.',
            data: new ProductResource($product)
        );
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
