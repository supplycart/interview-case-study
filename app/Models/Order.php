<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
