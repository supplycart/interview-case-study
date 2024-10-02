<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Get all products with optional filtering by user tier.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        // Get the user_tier from the query parameters (null if not provided)
        $userTier = $request->query('user_tier');

        // Fetch all products
        $products = Product::all()->map(function ($product) use ($userTier) {
            // Decode the price from JSON to an array
            $priceArray = json_decode($product->price, true);

            // If user_tier is provided, filter the price array to get the specific user tier price
            if ($userTier) {
                $filteredPrice = collect($priceArray)->firstWhere('user_tier', $userTier);

                // Return the product with only the price for the specified user tier
                return [
                    'id' => $product->id,
                    'product_name' => $product->product_name,
                    'product_brand' => $product->product_brand,
                    'product_category' => $product->product_category,
                    'price' => $filteredPrice ?: null, // Only the specific user tier price, null if not found
                    'quantity' => $product->quantity,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                ];
            } else {
                // If no user_tier is provided, return all price tiers
                return [
                    'id' => $product->id,
                    'product_name' => $product->product_name,
                    'product_brand' => $product->product_brand,
                    'product_category' => $product->product_category,
                    'price' => $priceArray, // Return all tier prices
                    'quantity' => $product->quantity,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                ];
            }
        });

        return response()->json($products);
    }
}
