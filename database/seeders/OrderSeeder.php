<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();

        foreach ($users as $user) {
            Order::create([
                'user_id' => $user,
                // TODO: maybe want make total price correct for seeder?
                'total_price' => rand(50, 500),
            ]);
        }
    }
}
