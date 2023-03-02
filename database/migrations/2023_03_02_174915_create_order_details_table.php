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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('product_id');
            $table->string('product_name');
            $table->string('category_name');
            $table->string('brand_name');
            $table->unsignedInteger('quantity');
            $table->decimal('price_per_quantity');
            $table->decimal('discount_per_quantity');
            $table->decimal('total_amount');
            $table->decimal('total_discount');
            $table->decimal('total_nett');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
