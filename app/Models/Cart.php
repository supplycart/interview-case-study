<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    // To scope for cart for the logged in user
    public function scopeUserCart(Builder $query) : void {
        $query->where('user_id', Auth::user()->id);
    }
}
