<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = "categories";
    //
    public function productCategories() {
        return $this->hasMany('App\ProductCategory');
    }
}
