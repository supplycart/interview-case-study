<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id', 'name', 
        'description', 'price',
        'slug', 'image',
        'price', 'weight'
    ];
}
