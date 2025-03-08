<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'id', 'created_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
