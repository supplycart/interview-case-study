<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public function product() {
        return $this->belongsTo('App\Product');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
