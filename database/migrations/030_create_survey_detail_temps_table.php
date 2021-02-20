<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyDetailTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_detail_temps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('survey_id')->unsigned()->nullable();
            $table->foreign('survey_id')->references('id')->on('surveys');

            $table->integer('resource_id')->unsigned()->nullable();
            $table->foreign('resource_id')->references('id')->on('resources');

            $table->string('survey')->default(0);

            $table->integer('suggestion_id')->unsigned()->nullable();
            $table->foreign('suggestion_id')->references('id')->on('survey_suggestions');

            $table->unsignedBigInteger('check_by')->nullable();
            $table->foreign('check_by')->references('id')->on('users');
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
        Schema::dropIfExists('survey_detail_temps');
    }
}
