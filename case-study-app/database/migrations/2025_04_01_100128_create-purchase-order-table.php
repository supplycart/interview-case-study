<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_cart')
                ->nullable(false);
            $table->foreign('id_cart')
                ->references('id')
                ->on('carts');

            $table->tinyInteger('status')
                ->nullable(false)
                ->comment("0: New PO, 1: PO Sent, 2: PO Complete, 3: PO Cancelled")
                ->default(0);

            $table->double('total_cost', 8, 2)
                ->nullable(false)
                ->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('purchase_orders');
    }
};
