<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Product extends Model
{
    use SoftDeletes;
    protected $table = "products";
    protected $fillable = ['name', 'price', 'status'];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
