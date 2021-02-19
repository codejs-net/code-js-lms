<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('receipt_id')->unsigned()->nullable();
            $table->foreign('receipt_id')->references('id')->on('receipts');

            $table->string('item')->nullable();
            $table->double('quentity', 6, 2)->nullable();
            $table->double('price', 8, 2)->nullable();
            $table->double('amount', 8, 2)->nullable();

            $table->string('note_si')->nullable();
            $table->string('note_ta')->nullable();
            $table->string('note_en')->nullable();

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
        Schema::dropIfExists('receipt_details');
    }
}
