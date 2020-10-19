<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }
}
