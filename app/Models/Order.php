<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_TO_PAY = 'TO_PAY';
    const STATUS_TO_RECEIVED = 'TO_RECEIVED';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->status) || is_null($model->status)) {

            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, OrderProduct::class);
    }

}
