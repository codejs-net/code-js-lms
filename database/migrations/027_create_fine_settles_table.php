<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFineSettlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fine_settles', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('lending_detail_id')->unsigned()->nullable();
            $table->foreign('lending_detail_id')->references('id')->on('lending_details');

            $table->string('settlement_type')->nullable();
            $table->string('receipt_id')->nullable();

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
        Schema::dropIfExists('fine_settles');
    }
}
