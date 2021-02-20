<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateSurveyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('survey_id')->unsigned()->nullable();
            $table->foreign('survey_id')->references('id')->on('surveys');

            $table->integer('resource_id')->unsigned()->nullable();
            $table->foreign('resource_id')->references('id')->on('resources');

            $table->string('accessionNo');
            $table->string('standard_number')->nullable();

            $table->string('title_si')->nullable();
            $table->string('title_ta')->nullable();
            $table->string('title_en')->nullable();
            
            $table->integer('cretor_id')->nullable();
            $table->string('cretor_name_si')->nullable();
            $table->string('cretor_name_ta')->nullable();
            $table->string('cretor_name_en')->nullable();

            $table->integer('category_id')->nullable();
            $table->string('category_si')->nullable();
            $table->string('category_ta')->nullable();
            $table->string('category_en')->nullable();

            $table->integer('type_id')->nullable();
            $table->string('type_si')->nullable();
            $table->string('type_ta')->nullable();
            $table->string('type_en')->nullable();

            $table->integer('center_id')->default(1);
            $table->string('center_name_si')->nullable();
            $table->string('center_name_ta')->nullable();
            $table->string('center_name_en')->nullable();

            $table->date('purchase_date')->default(Carbon::now());
            $table->string('edition')->nullable();
            $table->double('price', 4, 2);

            $table->string('phydetails')->nullable();

            $table->string('note_si')->nullable();
            $table->string('note_ta')->nullable();
            $table->string('note_en')->nullable();

            $table->string('status')->default(1);
            $table->string('lend')->default(0);
            $table->string('survey')->default(0);

            $table->integer('suggestion_id')->nullable();
            $table->string('suggestion')->nullable();

            $table->string('check_by')->nullable();

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
        Schema::dropIfExists('survey_details');
    }
}
