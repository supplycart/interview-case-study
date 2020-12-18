<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('short', 255);
            $table->text('description');
            $table->float('price', 8, 2, true);
            $table->string('thumb')->nullable();
            $table->enum('status', array(
            	'DRAFT',
	            'PUBLISH',
	            'BLOCKED',
	            'DELETE',
            ))->default('DRAFT');
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
        Schema::dropIfExists('products');
    }
}
