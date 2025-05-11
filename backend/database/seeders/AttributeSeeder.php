<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch categories
        $electronicsCategory = Category::where('name', 'Electronics')->first();
        $clothingCategory = Category::where('name', 'Clothing')->first();
        $booksCategory = Category::where('name', 'Books')->first();

        $attributes = [
            [
                'name' => 'Storage',
                'slug' => Str::slug('Storage'),
                'category_id' => $electronicsCategory->id ?? null, // Link to Electronics
            ],
            [
                'name' => 'Color',
                'slug' => Str::slug('Color'),
                'category_id' => $clothingCategory->id ?? null, // Link to Clothing
            ],
            [
                'name' => 'Size',
                'slug' => Str::slug('Size'),
                'category_id' => $clothingCategory->id ?? null, // Link to Clothing
            ],
            [
                'name' => 'Genre',
                'slug' => Str::slug('Genre'),
                'category_id' => $booksCategory->id ?? null, // Link to Books
            ],
            [
                'name' => 'Author',
                'slug' => Str::slug('Author'),
                'category_id' => $booksCategory->id ?? null, // Link to Books
            ],
            // Add other category-specific attributes as needed
        ];

        foreach ($attributes as $attribute) {
            // Create attributes, linking to category if category_id is not null
            Attribute::updateOrCreate(
                ['slug' => $attribute['slug']], // Find by slug
                $attribute                      // Update or create with this data
            );
        }
    }
}
