<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['total_price'];

    const STATUS_TO_PAY = 'TO_PAY';
    const STATUS_TO_RECEIVED = 'TO_RECEIVED';
    const CACHE_NAME = '_previous_orders';

    protected $casts = [
        'total_price' => 'float'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->status) || is_null($model->status)) {
                $model->status = static::STATUS_TO_PAY;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderedProducts()
    {
        return $this->hasMany(AddedProduct::class, 'order_id');
    }

    public static function getCacheKeyForUser()
    {
        return auth()->user()->id . static::CACHE_NAME;
    }
}
