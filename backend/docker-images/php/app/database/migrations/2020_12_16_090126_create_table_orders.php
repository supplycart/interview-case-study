<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id', false, true);
            $table->float('total_amount', 8, 2, true);
            $table->string('address');
            $table->enum('status', array(
                'ORDERED',
	            'DELETED',
	            'CONFIRM_DELIVERY',
	            'DELIVERED',
	            'DONE'
            ))->default('ORDERED');
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
