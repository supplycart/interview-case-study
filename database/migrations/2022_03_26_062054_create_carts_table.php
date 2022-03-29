<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("product_id");
            $table->integer("quantity");
            $table->unsignedBigInteger("order_id")->nullable();
            $table->unsignedTinyInteger("status")->comment("0 => In the cart, 1 => In an order & completed");

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
