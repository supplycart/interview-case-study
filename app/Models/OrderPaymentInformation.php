<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderPaymentInformation extends Model
{
    protected $guarded = [];

    public function status(): HasOne
    {
        return $this->hasOne(MasterLookup::class, 'id', 'status_id');
    }
}
