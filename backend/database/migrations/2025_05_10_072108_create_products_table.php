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
            $table->string('slug')->unique()->comment('SEO-friendly unique identifier for URLs');
            $table->text('description')->nullable();
            $table->integer('price_in_cents')->comment('Price stored in cents to avoid floating point issues');
            $table->integer('stock_quantity')->default(0);
            $table->timestamps();

            $table->index('name'); // Index for searching/sorting by name
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
