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
        Schema::create('carts', function (Blueprint $table) {
            $table->id('CartId');
            $table->unsignedBigInteger('ProductId');
            $table->unsignedBigInteger('UserId');
            $table->string('Status');
            $table->integer('Quantity');
            $table->float('Cost', 8, 2);

            $table->foreign('ProductId')->references('ProductId')->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('UserId')->references('UserId')->on('users')
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
        Schema::dropIfExists('cart');
    }
}
