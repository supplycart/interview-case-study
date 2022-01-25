<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_order_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_order_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            $table->index(["user_order_id"], "fk_user_order_product_user_orders1_idx");
            $table->index(["product_id"], "fk_user_order_product_products1_idx");

            $table->foreign("user_order_id", "fk_user_order_product_user_orders1_idx")->references("id")->on("user_orders")->onDelete("no action")->onUpdate("no action");
            $table->foreign("product_id", "fk_user_order_product_products1_idx")->references("id")->on("products")->onDelete("no action")->onUpdate("no action");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_order_product');
    }
}
