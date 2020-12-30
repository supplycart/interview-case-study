<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'is_admin' => true,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        // Member testers
        $normal = User::factory()->create([
            'name' => 'normal',
            'email' => 'normal@discount.com',
            'email_verified_at' => now(),
            'member_id' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        Cart::create(
            ['user_id' => $normal->id]
        );
        $five = User::factory()->create([
            'name' => '5Percent',
            'email' => '5percent@discount.com',
            'email_verified_at' => now(),
            'member_id' => 2,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        Cart::create(
            ['user_id' => $five->id]
        );
        $ten = User::factory()->create([
            'name' => '10Percent',
            'email' => '10percent@discount.com',
            'email_verified_at' => now(),
            'member_id' => 3,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        Cart::create(
            ['user_id' => $ten->id]
        );
    }
}
