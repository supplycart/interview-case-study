<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserLog;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserLogSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();
        $logTypes = ['login', 'logout', 'add_to_cart', 'remove_from_cart'];

        foreach ($users as $user) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                $logType = $logTypes[array_rand($logTypes)];

                $metadata = match ($logType) {
                    'login', 'logout' => ['ip_address' => fake()->ipv4(), 'user_agent' => fake()->userAgent()],
                    'add_to_cart', 'remove_from_cart' => ['product_id' => rand(1, 50), 'quantity' => rand(1, 3)],
                    default => [],
                };

                UserLog::create([
                    'user_id' => $user,
                    'type' => $logType,
                    'metadata' => $metadata,
                ]);
            }
        }
    }
}
