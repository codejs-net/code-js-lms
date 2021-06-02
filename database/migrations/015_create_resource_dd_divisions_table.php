<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceDdDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_dd_divisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dd_class_id')->nullable();
            $table->foreign('dd_class_id')->references('id')->on('resource_dd_classes');
            $table->string('devision_code')->nullable();
            $table->string('devision_si')->nullable();
            $table->string('devision_ta')->nullable();
            $table->string('devision_en')->nullable();
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
        Schema::dropIfExists('resource_dd_divisions');
    }
}
