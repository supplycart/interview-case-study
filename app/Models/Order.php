<?php

namespace App\Models;

use App\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->order_identifier = 'O-' . now()->format('ymd') . Str::upper(Str::random(8));
            $model->order_status = OrderStatus::PROCESSING->value;
        });
    }

    protected $fillable = [
        'grand_total',
        'discount',
        'tax',
        'net_price',
        'order_status',
        'contact_name',
        'contact_number',
        'address',
        'postcode',
        'city',
        'state',
        'remarks',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
