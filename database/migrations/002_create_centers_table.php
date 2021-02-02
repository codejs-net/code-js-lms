<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('library_id')->unsigned();
            $table->foreign('library_id')->references('id')->on('libraries');
            $table->string('name_si')->nullable();
            $table->string('name_ta')->nullable();
            $table->string('name_en')->nullable();
            $table->string('address1_si')->nullable();
            $table->string('address1_ta')->nullable();
            $table->string('address1_en')->nullable();
            $table->string('address2_si')->nullable();
            $table->string('address2_ta')->nullable();
            $table->string('address2_en')->nullable();
            $table->string('telephone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('centers');
    }
}
