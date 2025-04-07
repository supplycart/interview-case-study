<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->string('brand');
            $table->string('category');
            $table->integer('quantity');
            $table->string('status')->default('available');
            $table->timestamps();
        });

        // add sample data
        DB::table('products')->insert([
            [
                'name' => 'Laptop Product A',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => 9.99,
                'image' => 'https://placecats.com/200/200',
                'brand' => 'Brand A',
                'category' => 'Electronics',
                'quantity' => 100,
                'status' => 'Laptop',
            ],
            [
                'name' => 'Smartphone Product A',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => 59.99,
                'image' => 'https://placecats.com/201/201',
                'brand' => 'Brand A',
                'category' => 'Smartphone',
                'quantity' => 50,
                'status' => 'available',
            ],
            [
                'name' => 'Headphones Product A',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => 14.99,
                'image' => 'https://placecats.com/202/202',
                'brand' => 'Brand B',
                'category' => 'Headphones',
                'quantity' => 200,
                'status' => 'available',
            ],
            [
                'name' => 'Keyboard Product A',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => 7.99,
                'image' => 'https://placecats.com/203/203',
                'brand' => 'Brand B',
                'category' => 'Keyboard',
                'quantity' => 150,
                'status' => 'available',
            ],
            [
                'name' => 'Mouse Product',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => 4.99,
                'image' => 'https://placecats.com/204/204',
                'brand' => 'Brand A',
                'category' => 'Electronics',
                'quantity' => 250,
                'status' => 'available',
            ],
            [
                'name' => 'Monitor Product A',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => 19.99,
                'image' => 'https://placecats.com/205/205',
                'brand' => 'Brand B',
                'category' => 'Monitor',
                'quantity' => 120,
                'status' => 'available',
            ],
            [
                'name' => 'Mouse Pad Product A',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => 3.99,
                'image' => 'https://placecats.com/206/206',
                'brand' => 'Brand A',
                'category' => 'Mouse Pad',
                'quantity' => 300,
                'status' => 'available',
            ],
            [
                'name' => 'Mouse Product B',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => 5.99,
                'image' => 'https://placecats.com/207/207',
                'brand' => 'Brand B',
                'category' => 'Mouse',
                'quantity' => 200,
                'status' => 'available',
            ],
            [
                'name' => 'Mouse Pad Product B',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => 3.99,
                'image' => 'https://placecats.com/208/208',
                'brand' => 'Brand B',
                'category' => 'Mouse Pad',
                'quantity' => 300,
                'status' => 'available',
            ],
            [
                'name' => 'Monitor Product B',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => 19.99,
                'image' => 'https://placecats.com/209/209',
                'brand' => 'Brand B',
                'category' => 'Monitor',
                'quantity' => 120,
                'status' => 'available',
            ],
            [
                'name' => 'Keyboard Product B',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => 7.99,
                'image' => 'https://placecats.com/210/210',
                'brand' => 'Brand B',
                'category' => 'Keyboard',
                'quantity' => 150,
                'status' => 'available',
            ],
            [
                'name' => 'Headphones Product B',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => 14.99,
                'image' => 'https://placecats.com/211/211',
                'brand' => 'Brand B',
                'category' => 'Headphones',
                'quantity' => 200,
                'status' => 'available',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
