<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('attribute_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
        });

        DB::table('product_attributes')->insert([
            [
                'product_id' => 1,
                'attribute_id' => 1
            ],
            [
                'product_id' => 2,
                'attribute_id' => 1
            ],
            [
                'product_id' => 3,
                'attribute_id' => 2
            ],
            [
                'product_id' => 4,
                'attribute_id' => 2
            ],
            [
                'product_id' => 2,
                'attribute_id' => 3
            ],
            [
                'product_id' => 3,
                'attribute_id' => 3
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attributes');
    }
}
