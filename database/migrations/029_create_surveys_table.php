<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date')->default(Carbon::now());

            $table->integer('total_resources')->nullable();
            $table->integer('removed_resources')->nullable();
            $table->integer('lending_resources')->nullable();
            $table->integer('survey_resources')->nullable();
            $table->integer('non_survey_resources')->nullable();

            $table->integer('finalize')->default(0);
            $table->date('finalize_date')->nullable();

            $table->unsignedBigInteger('create_by')->nullable();
            $table->foreign('create_by')->references('id')->on('users');

            $table->unsignedBigInteger('finalize_by')->nullable();
            $table->foreign('finalize_by')->references('id')->on('users');


            $table->string('remark_si')->nullable();
            $table->string('remark_ta')->nullable();
            $table->string('remark_en')->nullable();
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
        Schema::dropIfExists('surveys');
    }
}
