<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('OrderId');
            $table->unsignedBigInteger('UserId');
            $table->unsignedBigInteger('CartId');

            $table->foreign('UserId')->references('UserId')->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('CartId')->references('CartId')->on('carts')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
