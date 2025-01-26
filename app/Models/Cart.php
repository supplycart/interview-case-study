<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';

    protected $fillable = ['user_id'];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with CartItem model
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}