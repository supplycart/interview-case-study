<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->text('description');
            $table->decimal('price',12,2)->index();
            $table->string('image_url');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->string('firstname')->index();
            $table->string('lastname')->index();
            $table->text('address');
            $table->string('phone')->index();
            $table->string('email')->index();
            $table->decimal('subtotal',12,2)->index();
            $table->decimal('delivery',12,2)->index();
            $table->decimal('discount',12,2)->index();
            $table->decimal('total',12,2)->index();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->bigInteger('order_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->decimal('price',12,2)->index();
            $table->integer('count')->index();
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
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('products');
    }
}
