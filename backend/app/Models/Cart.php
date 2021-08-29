<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $primaryKey = 'CartId';

    protected $table = 'cart';

    protected $fillable = [
        'CartId',
        'ProductId',
        'UserId',
    ];

    // get order detail related to this cart
    public function Order(){
        return $this->belongsTo(Order::class);
    }

    // get user detail related to this cart
    public function User(){
        return $this->belongsTo(User::class);
    }
}
