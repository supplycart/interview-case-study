<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 5 sample orders for each user
        $users = User::all();
        foreach ($users as $user) {
            Order::factory()->count(5)->create(['user_id' => $user->id]);
        }
    }
}
