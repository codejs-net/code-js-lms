<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceDdSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_dd_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dd_class_id')->nullable();
            $table->foreign('dd_class_id')->references('id')->on('resource_dd_classes');

            $table->unsignedBigInteger('dd_devision_id')->nullable();
            $table->foreign('dd_devision_id')->references('id')->on('resource_dd_divisions');

            $table->string('section_code')->nullable();
            $table->string('section_si')->nullable();
            $table->string('section_ta')->nullable();
            $table->string('section_en')->nullable();
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
        Schema::dropIfExists('resource_dd_sections');
    }
}
