<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'number',
        'currency',
        'total',
        'tax_rate',
        'tax_amount',
        'total_payable',
    ];

    public function items(): hasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
