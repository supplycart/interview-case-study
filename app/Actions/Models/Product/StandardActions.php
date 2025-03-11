<?php

namespace App\Actions\Models\Product;

use App\Models\Product;

class StandardActions
{
    public static function index($request)
    {
        $orderBy = $request['orderBy'] ?? 'id';
        $orderDirection = $request['orderDirection'] ?? 'asc';
        $paginate = $request['paginate'] ?? 15;

        if (!isset($request))
        {
            return Product::paginate($paginate);
        }

        $products = Product::query();

        if (isset($request['filters']) && !empty($request['filters']))
        {
            $filters = $request['filters'];

            $products->query()
                ->when(isset($filters['name']), function($subquery) use ($filters) { $subquery->where('name', $filters['name']); })
                ->when(isset($filters['email']), function($subquery) use ($filters) { $subquery->where('email', $filters['email']); })
                ->when(isset($filters['phone_no']), function($subquery) use ($filters) { $subquery->where('name', $filters['phone_no']); })
                ;
        }

        if (isset($request['search']))
        {
            $search = $request['search'];

            $products->query()
                ->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone_no', 'like', "%{$search}%")
                ;
        }

        return $products->orderBy($orderBy, $orderDirection)->paginate($paginate);
    }

    public static function show($id)
    {
        $product = Product::findOrFail($id);

        return $product;
    }

    public static function store($request)
    {
        $product = Product::create($request);

        return $product;
    }

    public static function update($id, $request)
    {
        $product = Product::findOrFail($id);
        $product = $product->update($request);

        return $product;
    }

    public static function delete($id)
    {
        $product = Product::findOrFail($id);
        $product = $product->delete();

        return $product;
    }
}
