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
            $table->text('description')->nullable(); // Optional description
            $table->decimal('price', 10, 2);
            $table->string('image_url')->nullable(); // Optional image URL
            $table->integer('stock')->nullable(); // Optional stock count
            $table->enum('category', ['Electronics', 'Fashion', 'Beauty', 'Home', 'Sports'])->default('Electronics');
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
