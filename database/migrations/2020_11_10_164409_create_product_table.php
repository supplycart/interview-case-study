<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable(false);
            $table->text('description')->nullable(false);
            $table->unsignedInteger('brand_id')->nullable(false);
            $table->unsignedInteger('category_id')->nullable(false);
            $table->unsignedInteger('unit')->nullable(false);
            $table->decimal('unit_price',8,2)->nullable(false);
            $table->timestamps();

            $table->index(['brand_id','category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
