<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLendingConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lending_configs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('categoryid')->unsigned()->default(1);
            $table->foreign('categoryid')->references('id')->on('member_cats');

            $table->string('lending_count')->nullable();
            $table->string('lending_period')->nullable();
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
        Schema::dropIfExists('lending_configs');
    }
}
