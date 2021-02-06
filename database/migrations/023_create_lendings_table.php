<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateLendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lendings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('members');

            $table->text('description_si')->nullable();
            $table->text('description_ta')->nullable();
            $table->text('description_en')->nullable();

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
        Schema::dropIfExists('lendings');
    }
}
