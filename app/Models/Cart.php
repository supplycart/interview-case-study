<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['product'];

    public function product() : HasOne {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
