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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_cart')
                ->nullable(false);
            $table->foreign('id_cart')
                ->references('id')
                ->on('carts');

            $table->integer('id_product')
                ->nullable(false);
            $table->foreign('id_product')
                ->references('id')
                ->on('products');

            $table->integer('quantity')
                ->nullable(false)
                ->default(0);

            $table->double('price', 8, 4)
                ->nullable(false)
                ->default(0.0000);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('cart_items');
    }
};
