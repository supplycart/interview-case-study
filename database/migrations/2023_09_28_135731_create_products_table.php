<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->text('description');
            $table->double('price', 8, 2);
            $table->timestamps();
        });

        DB::table('products')->insert([
            [
                'name' => 'Apple',
                'description' => 'I have an APPLE',
                'price' => 5.5
            ],
            [
                'name' => 'Banana',
                'description' => 'Bananaaaaaaa....... Potato naaaaaaaa......',
                'price' => 10.1
            ],
            [
                'name' => 'Cat',
                'description' => 'Meow...',
                'price' => 15
            ],
            [
                'name' => 'Donkey',
                'description' => 'Donkey D. Luffy',
                'price' => 19.9
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
