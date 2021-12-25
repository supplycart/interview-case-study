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
            $table->string('product_name');
            $table->enum('category', ['A', 'B']);
            $table->integer('stock')->default('0');
            $table->enum('discount_type', ['percentage']);
            $table->double('discount');
            $table->double('price');
            $table->string('picture_a')->nullable();
            $table->string('picture_b')->nullable();
            $table->string('picture_c')->nullable();
            $table->enum('status', ['active', 'disabled'])->default('active');
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
        Schema::dropIfExists('products');
    }
}
