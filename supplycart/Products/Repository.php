<?php

namespace Supplycart\Products;
use App\Models\Product;
use Auth;

class Repository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection 
     */
    public function getAll(): object
    {
        return Product::get();
    }

    /**
     * @param string $userId
     * @return \Illuminate\Database\Eloquent\Collection 
     */
    public function getAllwithSpecialPrice(): object
    {
        return Product::with(['special_prices' => function ($query) {
            $query->where('user_id', Auth::id());
        }])->get();
    }
}
