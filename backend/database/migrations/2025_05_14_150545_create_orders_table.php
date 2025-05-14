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
            $table->unsignedBigInteger('user_id');
            $table->string('number');
            $table->string('currency', 3);
            $table->string('tax_name', 3);
            $table->decimal('tax_rate', 5);
            $table->decimal('total', 40)->default(0.0);
            $table->decimal('tax_amount', 20)->default(0.0);
            $table->decimal('total_payable', 40)->default(0.0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
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
