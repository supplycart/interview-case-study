<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Seeder;

class RankingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = collect([
            [
                'name' => 'Top Rank',
                'description'=> 'Top ranking',
            ],
            [
                'name' => 'Medium Rank',
                'description'=> 'Medium ranking',
            ],
            [
                'name' => 'Low Rank',
                'description'=> 'Low ranking',
            ],
            [
                'name' => 'Basic',
                'description'=> 'Basic',
            ],
        ]);

        $data->each(function ($rank) {
            Rank::updateOrCreate($rank);
        });
    }
}
