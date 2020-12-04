<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('order_id')->nullable();
          $table->unsignedBigInteger('product_id')->nullable();
          $table->integer('amount')->default(0.00);
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::dropIfExists('order_products');
    }
}
