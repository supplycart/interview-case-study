<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRefRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_roles', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('description');
            $table->smallInteger('discount_percentage');
            $table->timestamps();
        });

        DB::table('ref_roles')->insert([
            [
                'description' => 'New Customer',
                'discount_percentage' => 30
            ],
            [
                'description' => 'Normal Customer',
                'discount_percentage' => 0
            ],
            [
                'description' => 'Royal Customer',
                'discount_percentage' => 15
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
        Schema::dropIfExists('ref_roles');
    }
}
