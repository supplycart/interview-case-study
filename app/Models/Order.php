<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total','delivered'];
    public function cart()
    {
        return $this->BelongsTo(ShoppingCart::class);
    }
}
