<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'id', 'created_at'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
