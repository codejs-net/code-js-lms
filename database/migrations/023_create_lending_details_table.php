<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateLendingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lending_details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('lending_id')->unsigned()->nullable();
            $table->foreign('lending_id')->references('id')->on('lendings');

            $table->date('issue_date')->default(Carbon::now());

            $table->boolean('return')->default(0)->change();
            $table->date('return_date');
            $table->boolean('fine')->default(0)->change();
            $table->double('fine_amount', 4, 2);

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
        Schema::dropIfExists('lending_details');
    }
}
