<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_products', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('cart_id')->nullable();
          $table->unsignedBigInteger('product_id')->nullable();
          $table->integer('amount')->default(0.00);
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('cart_id')->references('id')->on('carts');
          $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_products');
    }
}
