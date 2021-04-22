<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_boards', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('survey_id')->unsigned()->nullable();
            $table->foreign('survey_id')->references('id')->on('surveys');

            $table->integer('titleid')->unsigned()->nullable();
            $table->foreign('titleid')->references('id')->on('titles');

            $table->string('name_si')->nullable();
            $table->string('name_ta')->nullable();
            $table->string('name_en')->nullable();
            $table->string('office_si')->nullable();
            $table->string('office_ta')->nullable();
            $table->string('office_en')->nullable();

            $table->integer('genderid')->unsigned()->nullable();
            $table->foreign('genderid')->references('id')->on('genders');

            $table->string('survey_designetion')->nullable();
            $table->string('nic')->nullable();
            $table->string('mobile')->nullable();
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
        Schema::dropIfExists('survey_boards');
    }
}
