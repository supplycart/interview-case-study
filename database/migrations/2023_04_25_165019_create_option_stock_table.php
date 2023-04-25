<?php

use App\Models\Option;
use App\Models\Stock;
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
        Schema::create('option_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Option::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Stock::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_stock');
    }
};
