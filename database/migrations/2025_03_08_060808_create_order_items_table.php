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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained(table: 'orders', indexName: 'order_items_order_id');
            $table->foreignId('product_id')->constrained(table: 'products', indexName: 'order_items_product_id');

            // product details
            $table->string('product_title');
            $table->string('product_description')->nullable();

            // pricing details
            $table->decimal('unit_price', 8, 2);
            $table->unsignedInteger('quantity');
            $table->decimal('subtotal', 8, 2);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
