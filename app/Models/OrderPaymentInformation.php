<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderPaymentInformation extends Model
{
    protected $guarded = [];

    protected function cardNumber(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => substr($value, -4)
        );
    }

    public function status(): HasOne
    {
        return $this->hasOne(MasterLookup::class, 'id', 'status_id');
    }
}
