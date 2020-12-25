<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function productCategories() {
        return $this->hasMany('App\ProductCategory');
    }
}
