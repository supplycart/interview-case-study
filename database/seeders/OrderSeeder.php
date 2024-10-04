<?php

namespace Database\Seeders;

use App\Actions\Orders\StoreOrderAction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Auth::loginUsingId(1);

        $carts = [];
        for ($i = 1; $i <= 5; $i++) {
            $carts[] = [
                'product_id' => $i,
                'quantity'   => rand(1, 7)
            ];
        }

        Auth::user()->carts()->delete();
        Auth::user()->carts()->createMany($carts);

        $data = [
            'name'           => fake()->name(),
            'email'          => fake()->email(),
            'phone'          => fake()->phoneNumber(),
            'address'        => fake()->streetAddress(),
            'city'           => fake()->city(),
            'zipCode'        => fake()->numberBetween(10000, 99999),
            'state'          => fake()->word(),
            'cardNumber'     => fake()->creditCardNumber(),
            'cardExpiration' => now()->addYears(rand(1, 5))->format('m/y'),
            'saveInfo'       => false
        ];

        $storeOrderAction = new StoreOrderAction();
        $storeOrderAction->execute($data);
    }
}
