<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('direction_id')->unsigned();
            $table->integer('property_type_id')->unsigned();
            $table->integer('management_id')->unsigned();
            $table->string('description', 255)->nullable(false);
            $table->float('price')->nullable(false);
            $table->float('stratum')->nullable(false);
            $table->float('square_meter')->nullable(false);
            $table->integer('consultant_id')->unsigned();
            $table->timestamps();
            $table->foreign('direction_id')->references('id')->on('directions')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('property_type_id')->references('id')->on('property_types')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('management_id')->references('id')->on('managements')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('consultant_id')->references('id')->on('consultants')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
