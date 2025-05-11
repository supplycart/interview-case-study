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
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained('attributes')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('value')->comment('e.g., Nike, Electronics, Red, XL');
            $table->timestamps();


            $table->unique(['attribute_id', 'value']); // An attribute should have unique values
            // Foreign key attribute_id typically indexed.
            $table->index('attribute_id');
            $table->index('value'); // Index for searching by value
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_values');
    }
};
