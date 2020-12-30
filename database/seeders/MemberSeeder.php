<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::create([
            'level' => 'normal',
            'discount' => 1
        ]);
        Member::create([
            'level' => 'better',
            'discount' => 0.95
        ]);
        Member::create([
            'level' => 'best',
            'discount' => 0.9
        ]);
    }
}
