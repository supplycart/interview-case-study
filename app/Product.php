<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function productCategories() {
        return $this->hasMany('App\ProductCategory');
    }
    
    public function getCurrentPrice(){
        return auth()->user()->type == 'vip'
          ? number_format($this->cost * 0.8, 2, '.', '')
          : number_format($this->cost, 2, '.', '');
    }


}
