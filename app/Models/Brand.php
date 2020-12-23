<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
      'name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}