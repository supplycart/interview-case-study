<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\User;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assign carts to users
        User::all()->each(function ($user) {
            Cart::create([
                'user_id' => $user->id,
            ]);
        });
    }
}
