<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Rank;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->count(10)
            ->has(
                ProductPrice::factory()
                    ->count(4)
                    ->state(
                        new Sequence(
                            ['rank_id' => 1],
                            ['rank_id' => 2],
                            ['rank_id' => 3],
                            ['rank_id' => 4],
                        )
                    )
            )
            ->create();
    }
}
