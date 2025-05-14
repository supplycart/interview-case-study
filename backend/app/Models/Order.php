<?php

namespace App\Models;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'number',
        'currency',
        'tax_name',
        'tax_rate',
        'total',
        'tax_amount',
        'total_payable',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'total' => 'float',
            'tax_amount' => 'float',
            'total_payable' => 'float',
        ];
    }

    public function items(): hasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
