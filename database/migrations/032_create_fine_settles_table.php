<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
            $table->date('settlement_date')->default(Carbon::now());
            $table->integer('receipt_id')->nullable();
            $table->string('description_si')->nullable();
            $table->string('description_ta')->nullable();
            $table->string('description_en')->nullable();

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
