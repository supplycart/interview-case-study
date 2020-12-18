<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsers extends Migration
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
            $table->string('name', 191);
            $table->string('email', 191);
            $table->string('password', 191);
            $table->enum('status', array(
            	'NONE',
            	'ACTIVE',
	            'BLOCKED',
	            'DELETED'
            ))->default('NONE');
            $table->softDeletes();
            $table->timestamp('verified_at')
	            ->nullable()
	            ->comment('Store datetime verify email');
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
}
