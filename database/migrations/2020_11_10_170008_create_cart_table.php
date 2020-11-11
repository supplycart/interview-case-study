<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable(false);
            $table->unsignedInteger('product_id')->nullable(false);
            $table->unsignedInteger('unit')->nullable(false);
            $table->decimal('unit_price',8,2)->nullable(false);
            $table->timestamps();

            $table->index(['user_id','product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
