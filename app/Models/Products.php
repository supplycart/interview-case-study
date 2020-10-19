<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function brand() {
        return $this->belongsTo('App\Models\Brands');
    }

    public function category() {
        return $this->belongsTo('App\Models\Categories');
    }
}
