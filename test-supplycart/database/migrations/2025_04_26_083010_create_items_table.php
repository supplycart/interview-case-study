<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('quantity');
            $table->integer('price');
        });

        DB::table('items')->insert(
            array(
                'name' => 'Apple',
                'quantity' => 10,
                'price' => 100
            )
        );
        DB::table('items')->insert(
            array(
                'name' => 'Pear',
                'quantity' => 10,
                'price' => 100
            )
        );
        DB::table('items')->insert(
            array(
                'name' => 'Orange',
                'quantity' => 10,
                'price' => 100
            )
        );
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
