<?php

use Illuminate\Database\Seeder;
use App\Unit;
use App\Property;
use Carbon\Carbon;

class PropertyValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        DB::table('property_values')->truncate();

        $property_id = Property::where('name', 'Manufacturer')->first()->id;
        DB::table('property_values')->insert([
            [
                'property_id' => $property_id,
                'value' => 'Samsung',
                'unit_id' => NULL,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'property_id' => $property_id,
                'value' => 'Sony',
                'unit_id' => NULL,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'property_id' => $property_id,
                'value' => 'Bosch',
                'unit_id' => NULL,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'property_id' => $property_id,
                'value' => 'Nike',
                'unit_id' => NULL,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'property_id' => $property_id,
                'value' => 'Casio',
                'unit_id' => NULL,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'property_id' => $property_id,
                'value' => 'Polo',
                'unit_id' => NULL,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
        $property_id = Property::where('name', 'Quantity')->first()->id;
        $unit_kg = Unit::where('code', 'KG')->first()->id;
        DB::table('property_values')->insert([
            [
                'property_id' => $property_id,
                'value' => '1',
                'unit_id' => $unit_kg,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'property_id' => $property_id,
                'value' => '5',
                'unit_id' => $unit_kg,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'property_id' => $property_id,
                'value' => '10',
                'unit_id' => $unit_kg,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'property_id' => $property_id,
                'value' => '20',
                'unit_id' => $unit_kg,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'property_id' => $property_id,
                'value' => '50',
                'unit_id' => $unit_kg,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'property_id' => $property_id,
                'value' => '99.5',
                'unit_id' => $unit_kg,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
