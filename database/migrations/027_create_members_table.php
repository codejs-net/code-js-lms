<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('titleid')->unsigned()->default(1);
            $table->foreign('titleid')->references('id')->on('titles');

            $table->integer('categoryid')->unsigned()->default(1);
            $table->foreign('categoryid')->references('id')->on('member_cats');

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
            $table->date('birthday')->nullable();
           
            $table->integer('genderid')->unsigned()->nullable();
            $table->foreign('genderid')->references('id')->on('genders');

            $table->string('occupation_si')->nullable();
            $table->string('occupation_ta')->nullable();
            $table->string('occupation_en')->nullable();

            $table->string('Workplace_si')->nullable();
            $table->string('Workplace_ta')->nullable();
            $table->string('Workplace_en')->nullable();

            $table->string('email')->unique()->nullable();

            $table->string('description_si')->nullable();
            $table->string('description_ta')->nullable();
            $table->string('description_en')->nullable();

            $table->date('regdate')->default(Carbon::now());
            $table->string('image')->nullable();

            $table->integer('guarantor_id')->unsigned()->nullable();
            $table->foreign('guarantor_id')->references('id')->on('member_guarantors');

            $table->integer('center_id')->unsigned()->default(1);
            $table->foreign('center_id')->references('id')->on('centers')->default(1);

            $table->string('status')->default(1);
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
        Schema::dropIfExists('members');
    }
}
