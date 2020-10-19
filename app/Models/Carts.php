<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    public function product() {
        return $this->belongsTo('App\Models\Products');
    }
}
