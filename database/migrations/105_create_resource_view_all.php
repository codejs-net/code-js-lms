<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceViewAll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createView());

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }

    private function createView(): string
    {
        return <<<SQL
            CREATE VIEW view_resource_data_all AS
                SELECT  resources.id,
                        resources.accessionNo,
                        resources.standard_number,
                        resources.category_id,
                        resources.type_id,
                        resources.center_id,
                        resources.cretor_id,
                        resources.publisher_id,
                        resources.language_id,
                        resources.dd_class_id,
                        resources.dd_devision_id,
                        resources.dd_section_id,
                        resources.image,
                        resources.title_si,
                        resources.title_ta,
                        resources.title_en,
                        resources.ddc,
                        resources.price,
                        resources.purchase_date,
                        resources.edition,
                        resources.publishyear,
                        resources.phydetails,
                        resources.note_si,
                        resources.note_ta,
                        resources.note_en,
                        resources.status,
                        resources.received_type,
                        resource_categories.category_si,
                        resource_categories.category_ta,
                        resource_categories.category_en,
                        resource_types.type_si,
                        resource_types.type_ta,
                        resource_types.type_en,
                        resource_creators.name_si,
                        resource_creators.name_ta,
                        resource_creators.name_en,
                        resource_publishers.publisher_si,
                        resource_publishers.publisher_ta,
                        resource_publishers.publisher_en,
                        resource_languages.language_si,
                        resource_languages.language_ta,
                        resource_languages.language_en,
                        centers.name_si AS center_si,
                        centers.name_ta AS center_ta,
                        centers.name_en AS center_en,
                        resource_dd_classes.class_si,
                        resource_dd_classes.class_ta,
                        resource_dd_classes.class_en,
                        resource_dd_classes.class_code,
                        resource_dd_divisions.devision_si,
                        resource_dd_divisions.devision_ta,
                        resource_dd_divisions.devision_en,
                        resource_dd_divisions.devision_code,
                        resource_dd_sections.section_si,
                        resource_dd_sections.section_ta,
                        resource_dd_sections.section_en,
                        resource_dd_sections.section_code,
                        resource_places.rack,
                        resource_places.floor,
                        resource_places.index
                FROM    resources 
            LEFT JOIN   resource_categories     ON resources.category_id = resource_categories.id
            LEFT JOIN   resource_types          ON resources.type_id = resource_types.id
            LEFT JOIN   resource_creators       ON resources.cretor_id = resource_creators.id
            LEFT JOIN   resource_publishers     ON resources.publisher_id = resource_publishers.id
            LEFT JOIN   centers                 ON resources.center_id = centers.id
            LEFT JOIN   resource_languages      ON resources.language_id = resource_languages.id
            LEFT JOIN   resource_dd_classes     ON resources.dd_class_id = resource_dd_classes.id
            LEFT JOIN   resource_dd_divisions   ON resources.dd_devision_id = resource_dd_divisions.id
            LEFT JOIN   resource_dd_sections    ON resources.dd_section_id = resource_dd_sections.id
            LEFT JOIN   resource_places         ON resources.id = resource_places.resource_id
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_resource_data_all`;
        SQL;
    }
}
