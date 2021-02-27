<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    const DELIVERY_PRICE = 0.00;
    const DISCOUNT_PRICE = 0.00;
    const CURRENCY_EUR = 'EUR';
    const CURRENCY_EUR_RATE = 0.84;
    const CURRENCY_MYR_SIGN = 'RM';
    const CURRENCY_USD_SIGN = '$';
    const CURRENCY_EUR_SIGN = '€';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
    ];

    protected $visible = [
        'id',
        'name',
        'description',
        'price',
        'image_url',
    ];
}
