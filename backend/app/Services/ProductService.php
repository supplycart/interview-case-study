<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use App\Models\Category; // Import Category model
use App\Models\Brand; // Import Brand model
use App\Models\Attribute; // Import Attribute model
use App\Models\AttributeValue; // Import AttributeValue model
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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

        return Cache::remember($cacheKey, now()->addMinutes(self::CACHE_TTL_MINUTES), function () use ($filters, $user, $perPage) {
            $query = Product::query();

            // Eager load relationships for performance and to support attributes/pricing
            $query->with(['attributeValues.attribute', 'category', 'brand']); // Load category and brand directly

            // Apply Filters
            $this->applyTextSearchFilter($query, $filters);
            $this->applyPriceRangeFilter($query, $filters);
            $this->applyCategoryFilter($query, $filters);
            $this->applyBrandFilter($query, $filters);
            $this->applyAttributeFilters($query, $filters); // For color, size, etc.

            // Apply Sorting
            $sortBy = $filters['sort_by'] ?? 'created_at';
            $sortDirection = $filters['sort_direction'] ?? 'desc';
            // Ensure sortable column, including joined relationships if necessary (more complex)
            // For simplicity, stick to basic columns for now.
            if (in_array($sortBy, array_merge((new Product())->getFillable(), ['created_at', 'updated_at']))) {
                $query->orderBy($sortBy, $sortDirection);
            }


            $products = $query->paginate($perPage);

            // Apply Differential Pricing (Bonus)
            if ($user) {
                $products->getCollection()->transform(function (Product $product) use ($user) {
                    // Create a temporary attribute for the resource to pick up.
                    // The ProductResource will handle the actual pricing logic.
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
                ->with(['attributeValues.attribute', 'category', 'brand']) // Eager load
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
                // Use LIKE for broader SQL compatibility
                $q->where('name', 'LIKE', $searchTerm)
                    ->orWhere('description', 'LIKE', $searchTerm);
            });
        }
    }

    private function applyPriceRangeFilter(Builder $query, array $filters): void
    {
        if (isset($filters['min_price'])) {
            // Ensure correct type hinting or casting if necessary, though int * 100 is usually fine
            $query->where('price_in_cents', '>=', (int)$filters['min_price'] * 100);
        }
        if (isset($filters['max_price'])) {
            // Ensure correct type hinting or casting if necessary
            $query->where('price_in_cents', '<=', (int)$filters['max_price'] * 100);
        }
    }

    /**
     * Apply category filter based on category slug.
     */
    private function applyCategoryFilter(Builder $query, array $filters): void
    {
        if (!empty($filters['category_slug'])) {
            $query->whereHas('category', function (Builder $qCategory) use ($filters) {
                $qCategory->where('slug', $filters['category_slug']);
            });
        }
    }

    /**
     * Apply brand filter based on brand slug.
     */
    private function applyBrandFilter(Builder $query, array $filters): void
    {
        if (!empty($filters['brand_slug'])) {
            $query->whereHas('brand', function (Builder $qBrand) use ($filters) {
                $qBrand->where('slug', $filters['brand_slug']);
            });
        }
    }

    /**
     * Apply filtering based on generic product attributes (color, size, etc.).
     * Expects filters['attributes'] as an array of attribute value IDs.
     * Example: ['attributes' => [1, 5, 8]] where 1 is 'Red', 5 is 'M', 8 is '128GB'.
     *
     * Note: This applies an "AND" logic if multiple attribute values are provided.
     * A product must have *all* specified attribute values to be included.
     * Implementing "OR" logic (product has attribute value A *or* B) or
     * finding products that have *any* of a set of attribute values for a *single* attribute type
     * would require more complex joins or subqueries.
     */
    private function applyAttributeFilters(Builder $query, array $filters): void
    {
        if (!empty($filters['attribute_value_ids']) && is_array($filters['attribute_value_ids'])) {
            // Filter by a list of AttributeValue IDs
            $attributeValueIds = $filters['attribute_value_ids'];

            // To filter by multiple attribute values using AND logic (product must have all),
            // we join the `product_attribute_value` table multiple times or use a GROUP BY clause
            // to count the matches. The GROUP BY approach is generally more efficient.

            // Ensure we only count distinct attribute value matches per product.
            $query->whereIn('products.id', function ($subQuery) use ($attributeValueIds) {
                $subQuery->select('product_id')
                    ->from('product_attribute_value')
                    ->whereIn('attribute_value_id', $attributeValueIds)
                    ->groupBy('product_id')
                    ->havingRaw('COUNT(DISTINCT attribute_value_id) = ?', [count($attributeValueIds)]); // AND logic
            });
        }
    }
}
