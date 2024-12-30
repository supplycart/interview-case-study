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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_identifier', 16);
            $table->foreignId('user_id')->constrained();
            $table->decimal('grand_total', 14, 4)->default(0);
            $table->decimal('discount', 14, 4)->default(0);
            $table->decimal('tax', 14, 4)->default(0);
            $table->decimal('net_price', 14, 4)->default(0);
            $table->smallInteger('order_status');
            $table->string('contact_name');
            $table->string('contact_number');
            $table->string('address');
            $table->string('postcode', 6);
            $table->string('city');
            $table->string('state');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
