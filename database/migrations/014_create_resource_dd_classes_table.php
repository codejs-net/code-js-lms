<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceDdClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_dd_classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_code')->nullable();
            $table->string('class_si')->nullable();
            $table->string('class_ta')->nullable();
            $table->string('class_en')->nullable();
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
        Schema::dropIfExists('resource_dd_classes');
    }
}
