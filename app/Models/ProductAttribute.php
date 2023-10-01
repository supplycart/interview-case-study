<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductAttribute extends Model
{
    use HasFactory;

    public function attribute() : HasOne {
        return $this->hasOne(Attribute::class, 'id', 'attribute_id');
    }
}
