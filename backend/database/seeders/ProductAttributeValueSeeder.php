<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\AttributeValue;
use App\Models\Category; // Import Category model
use Illuminate\Database\Seeder;


class ProductAttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch categories and their associated attribute values
        $electronicsCategory = Category::with('attributes.attributeValues')->where('name', 'Electronics')->first();
        $clothingCategory = Category::with('attributes.attributeValues')->where('name', 'Clothing')->first();
        $booksCategory = Category::with('attributes.attributeValues')->where('name', 'Books')->first();

        // Fetch products by category
        $electronicsProducts = Product::where('category_id', $electronicsCategory->id ?? null)->get();
        $clothingProducts = Product::where('category_id', $clothingCategory->id ?? null)->get();
        $booksProducts = Product::where('category_id', $booksCategory->id ?? null)->get();

        // **Link specific products to specific attribute values**

        // Example: Link iPhone 14 to Storage options
        $iphone14 = Product::where('slug', 'iphone-14')->first();
        if ($iphone14 && $electronicsCategory) {
            $storageValues = $electronicsCategory->attributes->firstWhere('slug', 'storage')->attributeValues ?? collect();
            if ($storageValues->isNotEmpty()) {
                // Example: Link to 128GB and 256GB
                $valuesToAttach = $storageValues->whereIn('value', ['128GB', '256GB'])->pluck('id')->toArray();
                if (!empty($valuesToAttach)) {
                    $iphone14->attributeValues()->syncWithoutDetaching($valuesToAttach);
                }
            }
        }

        // Example: Link Galaxy S23 to Storage options
        $galaxyS23 = Product::where('slug', 'galaxy-s23')->first();
        if ($galaxyS23 && $electronicsCategory) {
            $storageValues = $electronicsCategory->attributes->firstWhere('slug', 'storage')->attributeValues ?? collect();
            if ($storageValues->isNotEmpty()) {
                // Example: Link to 256GB and 512GB
                $valuesToAttach = $storageValues->whereIn('value', ['256GB', '512GB'])->pluck('id')->toArray();
                if (!empty($valuesToAttach)) {
                    $galaxyS23->attributeValues()->syncWithoutDetaching($valuesToAttach);
                }
            }
        }


        // Example: Link T-Shirt (Padini) to Color and Size options
        $tshirtPadini = Product::where('slug', 't-shirt-padini')->first();
        if ($tshirtPadini && $clothingCategory) {
            $colorValues = $clothingCategory->attributes->firstWhere('slug', 'color')->attributeValues ?? collect();
            $sizeValues = $clothingCategory->attributes->firstWhere('slug', 'size')->attributeValues ?? collect();
            if ($colorValues->isNotEmpty() && $sizeValues->isNotEmpty()) {
                // Example: Link to Red, Blue, S, M, L
                $colorValuesToAttach = $colorValues->whereIn('value', ['Red', 'Blue'])->pluck('id')->toArray();
                $sizeValuesToAttach = $sizeValues->whereIn('value', ['S', 'M', 'L'])->pluck('id')->toArray();
                $valuesToAttach = array_merge($colorValuesToAttach, $sizeValuesToAttach);
                if (!empty($valuesToAttach)) {
                    $tshirtPadini->attributeValues()->syncWithoutDetaching($valuesToAttach);
                }
            }
        }

        // Example: Link Ultra Light Down Jacket (Uniqlo) to Color and Size options
        $jacketUniqlo = Product::where('slug', 'ultra-light-down-jacket-uniqlo')->first();
        if ($jacketUniqlo && $clothingCategory) {
            $colorValues = $clothingCategory->attributes->firstWhere('slug', 'color')->attributeValues ?? collect();
            $sizeValues = $clothingCategory->attributes->firstWhere('slug', 'size')->attributeValues ?? collect();
            if ($colorValues->isNotEmpty() && $sizeValues->isNotEmpty()) {
                // Example: Link to Black, M, L
                $colorValuesToAttach = $colorValues->whereIn('value', ['Black'])->pluck('id')->toArray();
                $sizeValuesToAttach = $sizeValues->whereIn('value', ['M', 'L'])->pluck('id')->toArray();
                $valuesToAttach = array_merge($colorValuesToAttach, $sizeValuesToAttach);
                if (!empty($valuesToAttach)) {
                    $jacketUniqlo->attributeValues()->syncWithoutDetaching($valuesToAttach);
                }
            }
        }

        // Example: Link Lagenda Budak Setan (FIXI) to Genre and Author options
        $lagendaBudakSetan = Product::where('slug', 'lagenda-budak-setan')->first();
        if ($lagendaBudakSetan && $booksCategory) {
            $genreValues = $booksCategory->attributes->firstWhere('slug', 'genre')->attributeValues ?? collect();
            $authorValues = $booksCategory->attributes->firstWhere('slug', 'author')->attributeValues ?? collect();
            if ($genreValues->isNotEmpty() && $authorValues->isNotEmpty()) {
                // Example: Link to Fiction, FIXI (assuming you might have Author as an attribute value)
                $genreValuesToAttach = $genreValues->whereIn('value', ['Fiction'])->pluck('id')->toArray();
                // Assuming Brand name can be an Author attribute value for simplicity here, adjust if authors are different from brands
                $authorValuesToAttach = $authorValues->whereIn('value', ['FIXI'])->pluck('id')->toArray(); // Adjust 'FIXI' based on actual Author values
                $valuesToAttach = array_merge($genreValuesToAttach, $authorValuesToAttach);
                if (!empty($valuesToAttach)) {
                    $lagendaBudakSetan->attributeValues()->syncWithoutDetaching($valuesToAttach);
                }
            }
        }

        // Example: Link Japanese Language Book (Kinokuniya) to Genre
        $japaneseBook = Product::where('slug', 'japanese-language-book')->first();
        if ($japaneseBook && $booksCategory) {
            $genreValues = $booksCategory->attributes->firstWhere('slug', 'genre')->attributeValues ?? collect();
            if ($genreValues->isNotEmpty()) {
                // Example: Link to Non-Fiction
                $valuesToAttach = $genreValues->whereIn('value', ['Non-Fiction'])->pluck('id')->toArray();
                if (!empty($valuesToAttach)) {
                    $japaneseBook->attributeValues()->syncWithoutDetaching($valuesToAttach);
                }
            }
        }


        // **Seed random product attribute values based on category**

        if ($electronicsProducts->isNotEmpty() && $electronicsCategory && $electronicsCategory->attributes->isNotEmpty()) {
            $allElectronicsAttributeValues = $electronicsCategory->attributes->flatMap->attributeValues;
            foreach ($electronicsProducts as $product) {
                // For each product, attach a random subset of relevant attribute values
                $randomValues = $allElectronicsAttributeValues->random(rand(1, min($allElectronicsAttributeValues->count(), 3))); // Attach 1 to 3 random values
                $product->attributeValues()->syncWithoutDetaching($randomValues->pluck('id')->toArray());
            }
        }

        if ($clothingProducts->isNotEmpty() && $clothingCategory && $clothingCategory->attributes->isNotEmpty()) {
            $allClothingAttributeValues = $clothingCategory->attributes->flatMap->attributeValues;
            foreach ($clothingProducts as $product) {
                // For each product, attach a random subset of relevant attribute values
                $randomValues = $allClothingAttributeValues->random(rand(1, min($allClothingAttributeValues->count(), 5))); // Attach 1 to 5 random values
                $product->attributeValues()->syncWithoutDetaching($randomValues->pluck('id')->toArray());
            }
        }

        if ($booksProducts->isNotEmpty() && $booksCategory && $booksCategory->attributes->isNotEmpty()) {
            $allBooksAttributeValues = $booksCategory->attributes->flatMap->attributeValues;
            foreach ($booksProducts as $product) {
                // For each product, attach a random subset of relevant attribute values
                $randomValues = $allBooksAttributeValues->random(rand(1, min($allBooksAttributeValues->count(), 3))); // Attach 1 to 3 random values
                $product->attributeValues()->syncWithoutDetaching($randomValues->pluck('id')->toArray());
            }
        }
    }
}
