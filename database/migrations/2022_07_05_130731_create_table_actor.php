<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableActor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('movie_id')->index()->nullable();
            $table->string('name')->nullable();
            $table->string('sex')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('biography')->nullable();
            $table->text('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actors');
    }
}
