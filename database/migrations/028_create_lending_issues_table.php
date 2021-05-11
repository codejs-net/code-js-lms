<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateLendingIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lending_issues', function (Blueprint $table) {
            $table->increments('id');
            $table->date('lending_date')->default(Carbon::now());

            $table->integer('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('members');

            // $table->integer('center_id')->unsigned()->nullable();
            // $table->foreign('center_id')->references('id')->on('centers');

            $table->text('description')->nullable();
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
        Schema::dropIfExists('lending_issues');
    }
}
