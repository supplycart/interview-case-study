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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 256);
            $table->string('email', 256)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 64);
            $table->string("phone_num", 16);
            $table->unsignedTinyInteger("role")->comment("1 => customer, 2 => member")->default(1);
            $table->string("address");
            $table->unsignedDecimal("balance", 10)->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
