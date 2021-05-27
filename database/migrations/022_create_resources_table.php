<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('accessionNo');
            $table->string('standard_number')->nullable();
            $table->string('title_si')->nullable();
            $table->string('title_ta')->nullable();
            $table->string('title_en')->nullable();
            
            $table->integer('cretor_id')->unsigned()->nullable();
            $table->foreign('cretor_id')->references('id')->on('resource_creators');

            $table->integer('cretor2_id')->unsigned()->nullable();
            $table->foreign('cretor2_id')->references('id')->on('resource_creators');

            $table->integer('cretor3_id')->unsigned()->nullable();
            $table->foreign('cretor3_id')->references('id')->on('resource_creators');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('resource_categories');

            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('resource_types');

            $table->unsignedBigInteger('dd_class_id')->nullable();
            $table->foreign('dd_class_id')->references('id')->on('resource_dd_classes');

            $table->unsignedBigInteger('dd_devision_id')->nullable();
            $table->foreign('dd_devision_id')->references('id')->on('resource_dd_divisions');

            $table->unsignedBigInteger('dd_section_id')->nullable();
            $table->foreign('dd_section_id')->references('id')->on('resource_dd_sections');

            $table->string('ddc')->nullable();

            $table->integer('center_id')->unsigned()->default(1);
            $table->foreign('center_id')->references('id')->on('centers')->default(1);

            $table->unsignedBigInteger('language_id')->nullable();
            $table->foreign('language_id')->references('id')->on('resource_languages');
      
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->foreign('publisher_id')->references('id')->on('resource_publishers');

            $table->date('purchase_date')->default(Carbon::now());
            $table->string('edition')->nullable();
            $table->double('price', 8, 2);

            $table->year('publishyear')->nullable();
            $table->string('phydetails')->nullable();
            $table->string('note_si')->nullable();
            $table->string('note_ta')->nullable();
            $table->string('note_en')->nullable();

            $table->string('status')->default(1);
            $table->string('br_qr_code')->nullable();
            $table->string('image')->nullable();
            $table->string('received_type')->nullable();

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
        Schema::dropIfExists('resources');
    }
}
