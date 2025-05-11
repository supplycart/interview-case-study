<?php

namespace Database\Seeders;


use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch attributes
        $storageAttribute = Attribute::where('slug', 'storage')->first();
        $colorAttribute = Attribute::where('slug', 'color')->first();
        $sizeAttribute = Attribute::where('slug', 'size')->first();
        $genreAttribute = Attribute::where('slug', 'genre')->first();
        $authorAttribute = Attribute::where('slug', 'author')->first();


        $attributeValues = [
            // Storage for Electronics
            [
                'attribute_id' => $storageAttribute->id ?? null,
                'value' => '128GB',
                'slug' => Str::slug('128GB'),
            ],
            [
                'attribute_id' => $storageAttribute->id ?? null,
                'value' => '256GB',
                'slug' => Str::slug('256GB'),
            ],
            [
                'attribute_id' => $storageAttribute->id ?? null,
                'value' => '512GB',
                'slug' => Str::slug('512GB'),
            ],

            // Colors for Clothing
            [
                'attribute_id' => $colorAttribute->id ?? null,
                'value' => 'Red',
                'slug' => Str::slug('Red'),
            ],
            [
                'attribute_id' => $colorAttribute->id ?? null,
                'value' => 'Blue',
                'slug' => Str::slug('Blue'),
            ],
            [
                'attribute_id' => $colorAttribute->id ?? null,
                'value' => 'Black',
                'slug' => Str::slug('Black'),
            ],

            // Sizes for Clothing
            [
                'attribute_id' => $sizeAttribute->id ?? null,
                'value' => 'S',
                'slug' => Str::slug('S'),
            ],
            [
                'attribute_id' => $sizeAttribute->id ?? null,
                'value' => 'M',
                'slug' => Str::slug('M'),
            ],
            [
                'attribute_id' => $sizeAttribute->id ?? null,
                'value' => 'L',
                'slug' => Str::slug('L'),
            ],

            // Genres for Books
            [
                'attribute_id' => $genreAttribute->id ?? null,
                'value' => 'Fiction',
                'slug' => Str::slug('Fiction'),
            ],
            [
                'attribute_id' => $genreAttribute->id ?? null,
                'value' => 'Non-Fiction',
                'slug' => Str::slug('Non-Fiction'),
            ],
            [
                'attribute_id' => $genreAttribute->id ?? null,
                'value' => 'Thriller',
                'slug' => Str::slug('Thriller'),
            ],

            // Authors for Books
            [
                'attribute_id' => $authorAttribute->id ?? null,
                'value' => 'Stephen King',
                'slug' => Str::slug('Stephen King'),
            ],
            [
                'attribute_id' => $authorAttribute->id ?? null,
                'value' => 'J.K. Rowling',
                'slug' => Str::slug('J.K. Rowling'),
            ],
            [
                'attribute_id' => $authorAttribute->id ?? null,
                'value' => 'Agatha Christie',
                'slug' => Str::slug('Agatha Christie'),
            ],

            // Add other attribute values as needed, linked to relevant attributes
        ];

        foreach ($attributeValues as $attributeValue) {
            // Create attribute values, linking to attribute if attribute_id is not null
            AttributeValue::updateOrCreate(
                ['slug' => $attributeValue['slug']], // Find by slug
                $attributeValue                      // Update or create with this data
            );
        }
    }
}
