<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_floors', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('rack_id')->default(1);
            $table->foreign('rack_id')->references('id')->on('resource_racks');

            $table->string('floor')->nullable();
            $table->string('floor_si')->nullable();
            $table->string('floor_ta')->nullable();
            $table->string('floor_en')->nullable();
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
        Schema::dropIfExists('resource_floors');
    }
}
