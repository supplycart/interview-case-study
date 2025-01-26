<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'quantity',
        'order_id'
    ];

     // Relationship with Order model
     public function order()
     {
         return $this->belongsTo(Order::class);
     }
 
     public function product()
     {
         return $this->belongsTo(Product::class);
     }
}