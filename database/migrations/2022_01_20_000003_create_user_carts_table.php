<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("quantity");
            $table->timestamps();
            
            $table->index(["product_id"], "fk_user_carts_products1_idx");
            $table->index(["user_id"], "fk_user_carts_users1_idx");

            $table->foreign("product_id", "fk_user_carts_products1_idx")->references("id")->on("products")->onDelete("no action")->onUpdate("no action");
            $table->foreign("user_id", "fk_user_carts_users1_idx")->references("id")->on("users")->onDelete("no action")->onUpdate("no action");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_carts');
    }
}
