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
        // carts
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->nullable()->index();
            $table->foreignId('product_id')->nullable()->index();
            $table->tinyInteger('quantity');
            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('carts');
            $table->foreign('product_id')->references('id')->on('products');
        });

        // orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->index();
            $table->decimal('total_price', 9, 3);
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users');
        });
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->index();
            $table->foreignId('product_id')->nullable()->index();
            $table->tinyInteger('quantity');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
    }
};
