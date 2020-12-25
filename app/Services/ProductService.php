<?php

namespace App\Services;

use App\UserOrder;
use App\Product;

class ProductService
{
    public static function getFilteredProducts($request)
    {
      
      $products = Product::all();    
      $products = Product::whereHas('productCategories', function ($query) use ($request) {                     
            if ($request->watch || $request->accessory) {
                $query->where('category_id', '=', $request->watch)
                    ->orWhere('category_id', '=', $request->accessory);
                    
            }                                  
        })->get();

        return $products;
    }                    
}
