<?php

namespace Supplycart\Products;
use App\Models\Product;

class Repository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection 
     */
    public function getAll(): object
    {
        return Product::get();
    }
}
