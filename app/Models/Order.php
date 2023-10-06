<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_PENDING = '0';
    const STATUS_COMPLETED = '10';
    const STATUS_CANCELLED = '20';

    const STATUS_ARRAY = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_COMPLETED => 'Completed',
        self::STATUS_CANCELLED => 'Cancel',
    ];

    const PAYMENT_STATUS_PENDING = '0';
    const PAYMENT_STATUS_PAID = '10';
    const PAYMENT_STATUS_FAILED = '20';

    const PAYMENT_STATUS_ARRAY = [
        self::PAYMENT_STATUS_PENDING => 'Pending',
        self::PAYMENT_STATUS_PAID => 'Paid',
        self::PAYMENT_STATUS_FAILED => 'Failed',
    ];

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_status'
    ];

    public function getStatusTextAttribute()
    {
        return self::STATUS_ARRAY[$this->status];
    }

    public function getPaymentStatusTextAttribute()
    {
        return self::PAYMENT_STATUS_ARRAY[$this->paymentStatus];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
