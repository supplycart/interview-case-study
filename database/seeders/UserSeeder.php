<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member = [   
            [
                'name' => 'Member',
                'email' => 'member@accenture.com',
                'email_verified_at' => null,
                'password' => Hash::make('password'),
                'remember_token' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        $role_member = Role::create(['name' => 'Member']);
        $permission_customer = Permission::create(['name' => 'customer']);

        foreach ($member as $members) {
            $user_member = User::create($members);
            $user_member->assignRole('Member');
        }

        $guest = [   
            [
                'name' => 'Guest',
                'email' => 'guest@accenture.com',
                'email_verified_at' => null,
                'password' => Hash::make('password'),
                'remember_token' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        $role_guest = Role::create(['name' => 'Guest']);

        foreach ($guest as $guests) {
            $user_guest = User::create($guests);
            $user_guest->assignRole('Guest');
        }

        $admin = [   
            [
                'name' => 'Admin',
                'email' => 'admin@accenture.com',
                'email_verified_at' => null,
                'password' => Hash::make('password'),
                'remember_token' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        $role_admin = Role::create(['name' => 'Admin']);
        $permission_admin = Permission::create(['name' => 'admin']);

        foreach ($admin as $admins) {
            $user_admin = User::create($admins);
            $user_admin->assignRole('Admin');
        }
    }
}
