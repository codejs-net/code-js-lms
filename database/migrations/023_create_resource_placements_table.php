<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcePlacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_placements', function (Blueprint $table) {
            $table->id();
            
            $table->integer('resource_id')->unsigned()->nullable();
            $table->foreign('resource_id')->references('id')->on('resources');

            $table->unsignedBigInteger('rack_id')->nullable();
            $table->foreign('rack_id')->references('id')->on('resource_racks');

            $table->unsignedBigInteger('floor_id')->nullable();
            $table->foreign('floor_id')->references('id')->on('resource_floors');

            $table->string('placement_index')->nullable();
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
        Schema::dropIfExists('resource_placements');
    }
}
