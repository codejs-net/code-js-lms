<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceCreatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_creators', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('titleid')->unsigned()->nullable();
            $table->foreign('titleid')->references('id')->on('titles');

            $table->string('name_si')->nullable();
            $table->string('name_ta')->nullable();
            $table->string('name_en')->nullable();
            $table->string('address1_si')->nullable();
            $table->string('address1_ta')->nullable();
            $table->string('address1_en')->nullable();
            $table->string('address2_si')->nullable();
            $table->string('address2_ta')->nullable();
            $table->string('address2_en')->nullable();
            $table->string('mobile')->nullable();
           
            $table->integer('genderid')->unsigned()->nullable();
            $table->foreign('genderid')->references('id')->on('genders');
            
            $table->string('description')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('resource_creators');
    }
}
