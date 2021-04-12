<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->date('receipt_date')->default(Carbon::now());

            $table->integer('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('members');

            $table->string('receipts')->nullable();
            $table->double('discount', 8, 2)->nullable();
            $table->double('tax', 8, 2)->nullable();
            $table->string('Payment_methord')->nullable();
            $table->double('payment', 8, 2)->nullable();
            $table->double('balance', 8, 2)->nullable();


            $table->string('description_si')->nullable();
            $table->string('description_ta')->nullable();
            $table->string('description_en')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('receipts');
    }
}
