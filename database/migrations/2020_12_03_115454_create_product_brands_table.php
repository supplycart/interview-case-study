<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_brands', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('product_id')->nullable();
          $table->unsignedBigInteger('brand_id')->nullable();
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('product_id')->references('id')->on('products');
          $table->foreign('brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_brands');
    }
}
