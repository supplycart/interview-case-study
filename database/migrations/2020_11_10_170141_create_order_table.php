<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable(false);
            $table->unsignedInteger('product_id')->nullable(false);
            $table->unsignedInteger('addr_id')->nullable(false);
            $table->unsignedInteger('unit')->nullable(false);
            $table->decimal('amount',12,2)->nullable(false);
            $table->enum('status',['0','1','2','3'])->nullable(false)->default('0')->comment('0-Payment Pending, 1-Processing, 2-Delivering, 3-Order Delivered');
            $table->timestamps();

            $table->index(['user_id','status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
