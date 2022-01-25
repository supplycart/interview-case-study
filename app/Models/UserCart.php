<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCart extends Model{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
