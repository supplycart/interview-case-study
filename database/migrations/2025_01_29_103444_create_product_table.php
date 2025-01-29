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
        Schema::create('product_brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('category_brands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->index();
            $table->foreignId('brand_id')->nullable()->index();
            $table->timestamps();
            
            $table->foreign('category_id')->references('id')->on('product_categories');
            $table->foreign('brand_id')->references('id')->on('product_brands');
        });
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->index();
            $table->foreignId('brand_id')->nullable()->index();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 9, 3);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('product_categories');
            $table->foreign('brand_id')->references('id')->on('product_brands');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('category_brands');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('product_brands');
    }
};
