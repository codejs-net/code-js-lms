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

            $table->integer('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('members');

            $table->integer('resource_id')->unsigned()->nullable();
            $table->foreign('resource_id')->references('id')->on('resources');

            $table->date('issue_date')->default(Carbon::now());

            $table->integer('return')->default(0);
            $table->date('return_date')->nullable();
            $table->double('fine_amount', 8, 2)->nullable();

            $table->string('remark_si')->nullable();
            $table->string('remark_ta')->nullable();
            $table->string('remark_en')->nullable();

            $table->unsignedBigInteger('issue_by')->nullable();
            $table->foreign('issue_by')->references('id')->on('users');

            $table->unsignedBigInteger('return_by')->nullable();
            $table->foreign('return_by')->references('id')->on('users');

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
