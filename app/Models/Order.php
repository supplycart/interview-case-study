<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['users_id', 'total_price'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
