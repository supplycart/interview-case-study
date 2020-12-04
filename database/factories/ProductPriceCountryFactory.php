<?php

namespace Database\Factories;

use App\Models\ProductPrice;
use App\Models\ProductPriceCountry;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPriceCountryFactory extends Factory
{
    protected $model = ProductPriceCountry::class;

    public function definition()
    {
        return [
            'product_price_id' => ProductPrice::factory(),
            'country' => collect(['MY', 'SG'])->random()
        ];
    }
}
