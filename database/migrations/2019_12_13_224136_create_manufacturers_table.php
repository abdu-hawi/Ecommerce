<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufacturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*

        'lat' ,
        'long' ,
        '',
    */
        Schema::create('manufacturers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('manufacturer_name_ar');
            $table->string('manufacturer_name_en');
            $table->integer('country_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('email')->nullable();
            $table->string('manufacturer_logo')->nullable();
            $table->string('address')->nullable();
            $table->string('site')->nullable();
            $table->integer('phone')->nullable();
            $table->double('lat')->nullable();
            $table->double('long')->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('city_id')->references('id')->on('cities');
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
        Schema::dropIfExists('manufacturers');
    }
}
