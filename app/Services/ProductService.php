<?php
namespace App\Services;

use App\Contracts\ProductContract;
use App\Models\Product;

class ProductService implements ProductContract
{
    public function getAll($request)
    {
        $product = Product::query();

        $product->when($request->has('brand'), function ($query) use ($request){
          return $query->where('brand_id', $request->brand);
        });

        $product->when($request->has('category'), function ($query) use ($request){
          return $query->where('category_id', $request->category);
        });

        return $product->with('brand')->get();
    }
}
