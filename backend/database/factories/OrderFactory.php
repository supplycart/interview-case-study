<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $country = Country::where('countries.code', 'MY')->first();

        return [
            'user_id' => User::factory(),
            'number' => getOrderRunningNumber(false),
            'currency' => $country->currency,
            'tax_name' => $country->tax_name,
            'tax_rate' => $country->tax_rate,
            'total' => 0.0,
            'tax_amount' => 0.0,
            'total_payable' => 0.0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
