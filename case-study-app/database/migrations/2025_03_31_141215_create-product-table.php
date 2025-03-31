<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name', 256)
                ->nullable(false);
            $table->double('product_price', 8, 4)
                ->nullable(false)
                ->default(0.0000);
            $table->timestamps();
        });

        for ($i = 0; $i <= 50; $i++)
        {
            $product = new Product();
            $product->product_name = "Product " . $i;
            $product->product_price = rand(1, 100);

            $product->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('products');
    }
};
