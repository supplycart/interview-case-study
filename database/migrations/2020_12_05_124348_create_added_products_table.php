<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddedProductsTable extends Migration
{
    public function up()
    {
        Schema::create('added_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->constrained('products');
            $table->unsignedBigInteger('order_id')
                ->nullable();
            $table->foreignId('product_prices_id')
                ->constrained('product_prices');
            $table->foreignId('user_id')
                ->constrained('users');
            $table->decimal('current_price', 19, 4)
                ->default(0);
            $table->integer('amount')
                ->default(1);
            $table->decimal('total', 19, 4)
                ->default(0);
            $table->foreign('order_id')
                ->references('id')
                ->on('orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('added_products');
    }
}
