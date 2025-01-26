<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';
    protected $fillable = [
        'invoice_number',
        'sub_total',
        'user_id'
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     // Relationship with OrderItem model
     public function orderItems()
     {
         return $this->hasMany(OrderItem::class);
     }

    
}