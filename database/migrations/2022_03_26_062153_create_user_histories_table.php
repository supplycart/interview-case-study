<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger("user_id");
            $table->unsignedTinyInteger("type")->comment("0 => register, 1 => login, 2 => logout".
                ", 3 => add to cart, 4 => Ordered, 5 => Recharge, 6 => verify email, 7 => upgrade to member");
            $table->unsignedBigInteger("related_id")->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_histories');
    }
};
