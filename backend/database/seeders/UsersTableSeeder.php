<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user = new User;
        $user->name = "Admin";
        $user->email = "admin@casestudy.com";
        $user->password = bcrypt('somePassword123');
        $user->is_admin = true;
        $user->save();
    }
}
