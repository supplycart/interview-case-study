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
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image_url')->nullable();
            $table->integer('stock')->nullable();
            $table->enum('category', ['Electronics', 'Fashion', 'Beauty', 'Home', 'Sports'])->default('Electronics');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->integer('category_num')->nullable();
            $table->timestamps();

            // Index brand_id and category_num
            $table->index('brand_id');
            $table->index('category_num');
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
