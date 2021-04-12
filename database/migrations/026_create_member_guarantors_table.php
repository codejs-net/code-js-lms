<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberGuarantorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_guarantors', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('titleid')->unsigned()->default(1);
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
            $table->string('nic')->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('member_guarantors');
    }
}
