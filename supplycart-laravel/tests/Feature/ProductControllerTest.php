<?php

use App\Models\Product;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

uses(RefreshDatabase::class);

// Test Product Index
it('can fetch products with their brands', function () {
    // Create test data
    $brand = Brand::factory()->create();
    $product = Product::factory()->create(['brand_id' => $brand->id]);

    // Send request to product index endpoint
    $response = $this->getJson('/api/products');

    // Assert that the response is successful
    $response->assertOk()
        ->assertJsonStructure([
            'products' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'image_url',
                    'stock',
                    'category',
                    'brand' => [
                        'id',
                        'name',
                    ]
                ]
            ],
            'brands' => [
                '*' => [
                    'id',
                    'name',
                ]
            ],
            'categories'
        ])
        ->assertJsonFragment([
            'id' => $product->id,
            'name' => $product->name,
        ]);
});
