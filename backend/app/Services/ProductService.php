<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB; // For complex attribute filtering

class ProductService
{
    const DEFAULT_PER_PAGE = 15;
    const CACHE_TTL_MINUTES = 10; // Cache duration

    /**
     * Get a paginated list of products with optional filtering and user-specific pricing.
     *
     * @param array $filters Validated filter data from ProductFilterRequest.
     * @param User|null $user The authenticated user for differential pricing.
     * @return LengthAwarePaginator
     */
    public function getProducts(array $filters, ?User $user = null): LengthAwarePaginator
    {
        $page = $filters['page'] ?? 1;
        $perPage = $filters['per_page'] ?? self::DEFAULT_PER_PAGE;
        $cacheKey = 'products_list_page_' . $page . '_per_page_' . $perPage . '_filters_' . md5(json_encode($filters)) . '_user_' . ($user ? $user->id : 'guest');

        return Cache::tags(['products'])->remember($cacheKey, now()->addMinutes(self::CACHE_TTL_MINUTES), function () use ($filters, $user, $perPage) {
            $query = Product::query();

            // Eager load relationships for performance and to support attributes/pricing
            $query->with(['attributeValues.attribute']); // For attribute display

            // Apply Filters (Bonus)
            $this->applyTextSearchFilter($query, $filters);
            $this->applyPriceRangeFilter($query, $filters);
            $this->applyAttributeFilters($query, $filters); // For category, brand, etc.

            // Apply Sorting
            $sortBy = $filters['sort_by'] ?? 'created_at';
            $sortDirection = $filters['sort_direction'] ?? 'desc';
            if (in_array($sortBy, (new Product())->getFillable()) || $sortBy === 'created_at') { // Ensure sortable column
                $query->orderBy($sortBy, $sortDirection);
            }


            $products = $query->paginate($perPage);

            // Apply Differential Pricing (Bonus)
            if ($user) {
                $products->getCollection()->transform(function (Product $product) use ($user) {
                    // Create a temporary attribute for the resource to pick up.
                    // The ProductResource will handle the actual pricing logic.
                    // This just signals that differential pricing *might* apply.
                    // Or, directly set a 'display_price_in_cents' attribute.
                    $product->user_specific_price_applied = true; // Flag for resource
                    return $product;
                });
            }

            return $products;
        });
    }

    /**
     * Get a single product by its slug, applying user-specific pricing.
     *
     * @param string $slug
     * @param User|null $user
     * @return Product|null
     */
    public function getProductBySlug(string $slug, ?User $user = null): ?Product
    {
        $cacheKey = 'product_slug_' . $slug . '_user_' . ($user ? $user->id : 'guest');

        return Cache::tags(['products', 'product_details'])->remember($cacheKey, now()->addMinutes(self::CACHE_TTL_MINUTES), function () use ($slug, $user) {
            $product = Product::where('slug', $slug)
                ->with(['attributeValues.attribute'])
                ->first();

            if ($product && $user) {
                $product->user_specific_price_applied = true; // Flag for resource
            }
            return $product;
        });
    }


    /**
     * Get the effective price for a product for a given user.
     *
     * @param Product $product
     * @param User $user
     * @return int Price in cents.
     */
    public function getProductPriceForUser(Product $product, User $user): int
    {
        // Check cache for user-specific price first
        $cacheKey = "user_product_price_{$user->id}_{$product->id}";
        $specificPrice = Cache::tags(['user_prices'])->remember($cacheKey, now()->addHours(1), function () use ($user, $product) {
            return $user->userProductPrices()->where('product_id', $product->id)->value('price_in_cents');
        });

        return $specificPrice ?? $product->price_in_cents;
    }

    // --- Private Helper Methods for Filtering ---

    private function applyTextSearchFilter(Builder $query, array $filters): void
    {
        if (!empty($filters['search'])) {
            $searchTerm = '%' . $filters['search'] . '%';
            $query->where(function (Builder $q) use ($searchTerm) {
                $q->where('name', 'ILIKE', $searchTerm) // ILIKE for case-insensitive (PostgreSQL)
                    ->orWhere('description', 'ILIKE', $searchTerm);
            });
        }
    }

    private function applyPriceRangeFilter(Builder $query, array $filters): void
    {
        if (isset($filters['min_price'])) {
            $query->where('price_in_cents', '>=', $filters['min_price'] * 100); // Assuming min_price is in dollars
        }
        if (isset($filters['max_price'])) {
            $query->where('price_in_cents', '<=', $filters['max_price'] * 100); // Assuming max_price is in dollars
        }
    }

    private function applyAttributeFilters(Builder $query, array $filters): void
    {
        // Example for 'category' and 'brand' if passed as direct filters
        // This assumes 'category' and 'brand' are attribute *names* and their values are filter values.
        $attributeFilters = [];
        if (!empty($filters['category'])) {
            $attributeFilters[] = ['name' => 'Category', 'value' => $filters['category']];
        }
        if (!empty($filters['brand'])) {
            $attributeFilters[] = ['name' => 'Brand', 'value' => $filters['brand']];
        }
        // Add more direct attribute filters (e.g., color, size) if they are top-level query params

        // Generic attribute filter if 'attributes' is an array:
        // ['attributes' => [ ['id' => 1, 'value' => 'Red'], ['id' => 2, 'value' => 'XL'] ] ]
        // Or ['attributes' => [ 'Color' => 'Red', 'Size' => 'XL' ] ] if mapping names to values
        if (!empty($filters['attributes']) && is_array($filters['attributes'])) {
            foreach ($filters['attributes'] as $attrFilter) {
                if (isset($attrFilter['name']) && isset($attrFilter['value'])) {
                    $attributeFilters[] = ['name' => $attrFilter['name'], 'value' => $attrFilter['value']];
                }
            }
        }

        foreach ($attributeFilters as $attrFilter) {
            $query->whereHas('attributeValues', function (Builder $qVal) use ($attrFilter) {
                $qVal->where('value', $attrFilter['value'])
                    ->whereHas('attribute', function (Builder $qAttr) use ($attrFilter) {
                        $qAttr->where('name', $attrFilter['name']);
                    });
            });
        }
    }
}
