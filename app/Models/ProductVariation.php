<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = ['name', 'sku', 'price'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
