<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public static function create($attributes) {
        $category = new Category($attributes);
        $category->save();
        return $category;
    }

    public function products() {
        return $this->hasMany(Product::class, "cat_id", "id");
    }
}
