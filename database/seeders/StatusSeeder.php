<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'id' => 1,
                'name' => 'New',
            ],

            [
                'id' => 2,
                'name' => 'Ordered',
            ],

            [
                'id' => 3,
                'name' => 'Received',
            ]
        ];

        foreach ($statuses as $status) {
            Status::updateOrCreate($status);
        }
    }
}
