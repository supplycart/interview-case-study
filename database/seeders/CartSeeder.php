<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\User;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();

        foreach ($users as $user) {
            Cart::create([
                'user_id' => $user
            ]);
        }
    }
}
