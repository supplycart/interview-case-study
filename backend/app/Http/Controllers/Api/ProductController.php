<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductFilterRequest;
use App\Services\ProductService;
use App\Http\Resources\ProductCollection; // For paginated list
use App\Http\Resources\ProductResource;   // For single product
use Illuminate\Http\Request; // For authenticated user access
use App\Models\Product; // For route model binding for show method

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        // $this->middleware('auth:sanctum')->except(['index', 'show']); // Example if some methods are public
    }

    /**
     * Display a listing of the products.
     * Authenticated users must be able to view a list of available products.
     */
    public function index(ProductFilterRequest $request): ProductCollection
    {
        // ProductFilterRequest handles validation of query parameters
        $filters = $request->validated();
        $user = $request->user(); // User can be null if endpoint is public

        $products = $this->productService->getProducts($filters, $user);

        return new ProductCollection($products);
    }

    /**
     * Display the specified product.
     * (Not explicitly in core tasks, but good for 'Add to Cart' context)
     *
     * Using Route Model Binding with 'slug' (defined in Product model getRouteKeyName).
     */
    public function show(Product $product, Request $request): ProductResource // Product is resolved by slug
    {
        $user = $request->user();
        // Service method handles user-specific pricing logic if user is present.
        // We just need to make sure the ProductResource can access the user.
        // Reload with necessary relations if not eager loaded by default or for specific context.
        $product->loadMissing(['attributeValues.attribute']);

        if ($user) {
            // This flag helps ProductResource to attempt retrieving user-specific price.
            $product->user_specific_price_applied = true;
        }

        return new ProductResource($product);
    }
}
