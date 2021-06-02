<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateResourceDonatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_donates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resource_id')->unsigned()->nullable();
            $table->foreign('resource_id')->references('id')->on('resources');

            $table->integer('titleid')->unsigned()->nullable();
            $table->foreign('titleid')->references('id')->on('titles');

            $table->string('doner_name_si')->nullable();
            $table->string('doner_name_ta')->nullable();
            $table->string('doner_name_en')->nullable();
            $table->string('doner_address1_si')->nullable();
            $table->string('doner_address1_ta')->nullable();
            $table->string('doner_address1_en')->nullable();
            $table->string('doner_address2_si')->nullable();
            $table->string('doner_address2_ta')->nullable();
            $table->string('doner_address2_en')->nullable();
            $table->string('doner_mobile')->nullable();

            $table->integer('genderid')->unsigned()->nullable();
            $table->foreign('genderid')->references('id')->on('genders');
            
            $table->string('donete_description')->nullable();
            $table->date('donate_date')->default(Carbon::now());
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
        Schema::dropIfExists('resource_donates');
    }
}
