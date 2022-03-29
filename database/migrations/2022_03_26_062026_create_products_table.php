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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("name", 256);
            $table->string("picture");
            $table->unsignedBigInteger("cat_id");
            $table->unsignedDecimal("price", 10);
            $table->integer("inventory")->default(0);
            $table->text("description");
            $table->string("tags");

            $table->foreign('cat_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('restrict');
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
};
