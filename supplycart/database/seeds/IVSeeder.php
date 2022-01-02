<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Product;
use Carbon\Carbon;

class IVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->created_at   = Carbon::now();
        $user->updated_at   = Carbon::now();
        $user->name         = "Azmin";
        $user->email        = "am211@yahoo.com";
        $user->password     = '$2y$10$D4tALLgZzOak3zQC3Uq8TO8yde6tiAusJcAp0flW9ikHGrTKCpRD6';
        $user->role_id      = null;
        $user->save();

        $user = new User;
        $user->created_at   = Carbon::now();
        $user->updated_at   = Carbon::now();
        $user->name         = "Member";
        $user->email        = "member@yahoo.com";
        $user->password     = '$2y$10$D4tALLgZzOak3zQC3Uq8TO8yde6tiAusJcAp0flW9ikHGrTKCpRD6';
        $user->role_id      = 1;
        $user->save();

        $user = new User;
        $user->created_at   = Carbon::now();
        $user->updated_at   = Carbon::now();
        $user->name         = "Staff";
        $user->email        = "staff@yahoo.com";
        $user->password     = '$2y$10$D4tALLgZzOak3zQC3Uq8TO8yde6tiAusJcAp0flW9ikHGrTKCpRD6';
        $user->role_id      = 2;
        $user->save();

        $roles = ['member', 'staff'];
        foreach ($roles as $key => $value) {
          $role = new Role;
          $role->created_at = Carbon::now();
          $role->updated_at = Carbon::now();
          $role->name       = $value;
          $role->save();
        }

        $products = [
          ['Electronic Accessories',   'Xiaomi',    'Headphone', 20.50],
          ['Electronic Accessories',   'Samsung',   'Galaxy 13 pro', 20.55],
          ['Electronic Accessories',   'Samseng',   'Smart Speaking Rope', 16],
          ['Groceries & Pets',         'Alpo',      'Makanan Kucing Murah', 105],
          ['Groceries & Pets',         'Frieskies', 'Makanan Kucing Mahal', 420],
          ['Fashion Accessories',      'Nike',      'Air Force', 52],
          ['Babies & Toys',            'Anakku',    'Toddler Singlet', 123],
          ['Health & Beauty',          null,         'Bedak Timbang Siam', 0.50],
          ['Electronic Devices',       'Xiaomi',    'Smart Shoes', 9.3],
          ['Electronic Devices',       'Motorola',  'Not so smart watch', 40],
          ['Electronic Devices',       'Tribit',    'Bluetooth Headphone', 16],
          ['Electronic Devices',       'Nikon',     'DSLR (body only)', 203],
        ];

        foreach ($products as $key => $value) {
          $product = new Product;
          $product->created_at = Carbon::now();
          $product->updated_at = Carbon::now();
          $product->category   = $value[0];
          $product->brand      = $value[1];
          $product->name       = $value[2];
          $product->price      = $value[3];
          $product->save();
        }
    }
}
