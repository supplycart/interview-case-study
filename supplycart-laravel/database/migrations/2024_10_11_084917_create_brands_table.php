<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Brand name should be unique
            $table->timestamps();
        });

        // Add brand_id and category_num to products table
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('brand_id')->nullable()->after('id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
            $table->integer('category_num')->nullable()->after('price'); // Add category number field
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop foreign key and columns from products table first
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropColumn('brand_id');
            $table->dropColumn('category_num');
        });

        Schema::dropIfExists('brands');
    }
}
