<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $with = ["category"];

    protected $fillable = [
        "name",
        "picture",
        "cat_id",
        "price",
        "inventory",
        "description",
        "tags"
    ];

    public static function create($attributes) {
        $product = new Product($attributes);
        $product->save();
        return $product;
    }

    public function category() {
        return $this->belongsTo(Category::class, "cat_id", "id");
    }
}
