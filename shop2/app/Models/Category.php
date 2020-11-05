<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function Subcategories(){
        return $this->hasMany(Subcategory::class);
    }

    public function Products(){
        return $this->hasMany(Category::class);
    }
}
