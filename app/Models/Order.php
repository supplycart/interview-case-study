<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'status', 'order_items'];

    protected $casts = [
        'order_items' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        $productIds = collect($this->order_items)->pluck('product_id')->toArray();
        return Product::whereIn('id', $productIds)->get();
    }
}
