<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected static function boot()
    {
        parent::boot();

        self::saving(function (self $model) {
            if (!$model->order_number) {
                $model->order_number = Carbon::now()->format('YmdHis').'-'.uniqid();
            }
        });

        self::saved(function (self $model) {
            OrderLog::create([
                'order_id'  => $model->id,
                'status_id' => $model->status_id,
            ]);
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function paymentInfo(): HasOne
    {
        return $this->hasOne(OrderPaymentInformation::class, 'order_id', 'id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(MasterLookup::class, 'id', 'status_id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id');
    }
}
