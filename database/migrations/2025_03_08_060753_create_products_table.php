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
            $table->foreignId('category_id')->constrained(table: 'categories', indexName: 'products_category_id');

            // product details
            $table->string('title', 100);
            $table->longText('description')->nullable()->comment('possibility of using quill or summernote');

            // pricing details
            $table->decimal('base_price', 8, 2);
            $table->enum('discount_type_for_member', ['percentage', 'fixed'])->nullable();
            $table->decimal('discounted_rate_for_member', 4, 2)->nullable()->comment('maximum: 99.99%');
            $table->decimal('discounted_price_for_member', 8, 2)->nullable();

            // to show or not to show the product in the listing
            $table->boolean('is_available')->default(true);

            $table->timestamps();
            $table->softDeletes();
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
