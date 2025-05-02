<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function paginateWithRelations(int $perPage = 10, array $filters = [])
    {
        $query = Product::with(['category', 'brand']);

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where('name', 'LIKE', "%$search%");
        }

        if (!empty($filters['brand_id'])) {
            $query->where('brand_id', $filters['brand_id']);
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        return $query->paginate($perPage)->withQueryString();
    }
}
