<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPriceCountry extends Model
{
    use HasFactory;

    const MALAYSIA_CODE = 'MY';
    const SINGAPORE_CODE = 'SG';

    protected $fillable = [
        'country_code', 'product_id'
    ];

    public function productPrice()
    {
        return $this->belongsTo(ProductPrice::class);
    }

    public static function countriesAvailable()
    {
        return [static::MALAYSIA_CODE, static::SINGAPORE_CODE];
    }
}
