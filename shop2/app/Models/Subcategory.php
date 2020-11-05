<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    public function Category(){
        return $this->belongsTo(Subcategory::class);
    }

    public function Products(){
        return $this->hasMany(Category::class);
    }
}
