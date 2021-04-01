<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $appends = ['formatted_shipping_info'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s A',
    ];

    protected $fillable = [
        'order_number',
        'user_id',
        'total',
        'item_count',
        'shipping_info',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
            ->withPivot(
                'order_id',
                'product_id',
                'quantity',
                'unit_price',
            );
    }

    public function getFormattedShippingInfoAttribute()
    {
        $shippingInfo = json_decode($this->shipping_info, true);
        $firstName = $shippingInfo['first_name'] ?? '';
        $lastName = $shippingInfo['last_name'] ?? '';
        $phoneNumber = $shippingInfo['phone_number'] ?? '';
        $streetAddress = $shippingInfo['street_address'] ?? '';
        $city = $shippingInfo['city'] ?? '';
        $state = $shippingInfo['state'] ?? '';
        $postcode = $shippingInfo['postcode'] ?? '';
        $country = $shippingInfo['country'] ?? '';

        $formatted = implode("\n\r", [
            "{$firstName} {$lastName}",
            "{$phoneNumber}",
            "{$streetAddress}",
            "{$city} {$state}",
            "{$postcode}",
            "{$country}",
        ]);

        return preg_replace('/[ \t]+/', ' ', preg_replace('/\s*$^\s*/m', "\n", $formatted));
    }
}
