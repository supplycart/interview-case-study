<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductAndPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countryIdMY = Country::where('code', 'MY')->first()->id;
        $countryIdSG = Country::where('code', 'SG')->first()->id;
        $countryIdID = Country::where('code', 'ID')->first()->id;
        $countryIdTH = Country::where('code', 'TH')->first()->id;

        $categoryIdMoped = Category::where('name', 'Moped')->first()->id;
        $categoryIdScooter = Category::where('name', 'Scooter')->first()->id;

        /**
         * Brand - Honda
         */
        $brandIdHonda = Brand::where('name', 'Honda')->first()->id;
        $itemsHonda = [
            [
                'name' => 'Dash 125 / Supra X 125',
                'category_id' => $categoryIdMoped,
                'prices' => [
                    ['country_id' => $countryIdMY, 'amount' => 6_599],
                    ['country_id' => $countryIdSG, 'amount' => null],
                    ['country_id' => $countryIdID, 'amount' => 20_750_000],
                    ['country_id' => $countryIdTH, 'amount' => null],
                ],
            ],
            [
                'name' => 'RS150R / RS-X / Supra GTR 150',
                'category_id' => $categoryIdMoped,
                'prices' => [
                    ['country_id' => $countryIdMY, 'amount' => 8_379],
                    ['country_id' => $countryIdSG, 'amount' => 14_800],
                    ['country_id' => $countryIdID, 'amount' => 26_715_000],
                    ['country_id' => $countryIdTH, 'amount' => 99_700],
                ],
            ],
            [
                'name' => 'BeAT',
                'category_id' => $categoryIdScooter,
                'prices' => [
                    ['country_id' => $countryIdMY, 'amount' => 6_090],
                    ['country_id' => $countryIdSG, 'amount' => null],
                    ['country_id' => $countryIdID, 'amount' => 18_880_000],
                    ['country_id' => $countryIdTH, 'amount' => null],
                ],
            ],
            [
                'name' => 'ADV 160',
                'category_id' => $categoryIdScooter,
                'prices' => [
                    ['country_id' => $countryIdMY, 'amount' => 13_549],
                    ['country_id' => $countryIdSG, 'amount' => 14_486],
                    ['country_id' => $countryIdID, 'amount' => 37_340_000],
                    ['country_id' => $countryIdTH, 'amount' => 114_000],
                ],
            ],
        ];
        $this->generateProductAndPrices($itemsHonda, $brandIdHonda);

        /**
         * Brand - Yamaha
         */
        $brandIdYamaha = Brand::where('name', 'Yamaha')->first()->id;
        $itemsYamaha = [
            [
                'name' => '135LC',
                'category_id' => $categoryIdMoped,
                'prices' => [
                    ['country_id' => $countryIdMY, 'amount' => 8_298],
                    ['country_id' => $countryIdSG, 'amount' => null],
                    ['country_id' => $countryIdID, 'amount' => null],
                    ['country_id' => $countryIdTH, 'amount' => null],
                ],
            ],
            [
                'name' => 'Y15ZR / Sniper 150 / MX King / Exciter 150',
                'category_id' => $categoryIdMoped,
                'prices' => [
                    ['country_id' => $countryIdMY, 'amount' => 8_998],
                    ['country_id' => $countryIdSG, 'amount' => 3_500],
                    ['country_id' => $countryIdID, 'amount' => 23_000_000],
                    ['country_id' => $countryIdTH, 'amount' => 65_000],
                ],
            ],
            [
                'name' => 'NVX / Aerox 155',
                'category_id' => $categoryIdScooter,
                'prices' => [
                    ['country_id' => $countryIdMY, 'amount' => 9_598],
                    ['country_id' => $countryIdSG, 'amount' => 11_077],
                    ['country_id' => $countryIdID, 'amount' => 29_900_000],
                    ['country_id' => $countryIdTH, 'amount' => 63_900],
                ],
            ],
            [
                'name' => 'NMAX',
                'category_id' => $categoryIdScooter,
                'prices' => [
                    ['country_id' => $countryIdMY, 'amount' => 9_798],
                    ['country_id' => $countryIdSG, 'amount' => 12_800],
                    ['country_id' => $countryIdID, 'amount' => 35_750_000],
                    ['country_id' => $countryIdTH, 'amount' => 88_900],
                ],
            ],
        ];
        $this->generateProductAndPrices($itemsYamaha, $brandIdYamaha);

        /**
         * Brand - Suzuki
         */
        $brandIdSuzuki = Brand::where('name', 'Suzuki')->first()->id;
        $itemsSuzuki = [
            [
                'name' => 'Raider R150 / Satria F150',
                'category_id' => $categoryIdMoped,
                'prices' => [
                    ['country_id' => $countryIdMY, 'amount' => 8_379],
                    ['country_id' => $countryIdSG, 'amount' => null],
                    ['country_id' => $countryIdID, 'amount' => 29_165_000],
                    ['country_id' => $countryIdTH, 'amount' => null],
                ],
            ],
            [
                'name' => 'Avenis 125',
                'category_id' => $categoryIdScooter,
                'prices' => [
                    ['country_id' => $countryIdMY, 'amount' => 6_980],
                    ['country_id' => $countryIdSG, 'amount' => null],
                    ['country_id' => $countryIdID, 'amount' => 30_180_000],
                    ['country_id' => $countryIdTH, 'amount' => null],
                ],
            ],
        ];
        $this->generateProductAndPrices($itemsSuzuki, $brandIdSuzuki);
    }

    /**
     * @param array $items
     * @param mixed $brandId
     * @return void
     */
    private function generateProductAndPrices(array $items, mixed $brandId): void
    {
        $count = count($items);

        $productsHonda = Product::factory()
            ->count($count)
            ->sequence(function ($sequence) use ($items) {
                $item = $items[$sequence->index];
                unset($item['prices']);
                return $item;
            })
            ->create(['description' => fake()->text(), 'brand_id' => $brandId]);
        foreach ($productsHonda as $index => $product) {
            Price::factory()
                ->count(4)
                ->sequence(function ($sequence) use ($index, $items) {
                    return $items[$index]['prices'][$sequence->index];
                })
                ->create(['product_id' => $product->id]);
        }
    }
}
