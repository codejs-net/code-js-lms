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
                SELECT  resources.*,
                        resource_categories.category_si,
                        resource_categories.category_ta,
                        resource_categories.category_en,
                        resource_types.type_si,
                        resource_types.type_ta,
                        resource_types.type_en,
                        creator1.name_si,
                        creator1.name_ta,
                        creator1.name_en,
                        creator2.name_si AS name2_si,
                        creator2.name_ta AS name2_ta,
                        creator2.name_en AS name2_en,
                        creator3.name_si AS name3_si,
                        creator3.name_ta AS name3_ta,
                        creator3.name_en AS name3_en,
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
                        resource_placements.rack_id,
                        resource_placements.floor_id,
                        resource_placements.placement_index,
                        resource_racks.rack_si,
                        resource_racks.rack_ta,
                        resource_racks.rack_en,
                        resource_floors.floor_si,
                        resource_floors.floor_ta,
                        resource_floors.floor_en
                FROM    resources 
            LEFT JOIN   resource_categories     ON resources.category_id            = resource_categories.id
            LEFT JOIN   resource_types          ON resources.type_id                = resource_types.id
            LEFT JOIN   resource_creators   AS creator1  ON resources.cretor_id     = creator1.id 
            LEFT JOIN   resource_creators   AS creator2  ON resources.cretor2_id    = creator2.id
            LEFT JOIN   resource_creators   AS creator3  ON resources.cretor3_id    = creator3.id
            LEFT JOIN   resource_publishers     ON resources.publisher_id           = resource_publishers.id
            LEFT JOIN   centers                 ON resources.center_id              = centers.id
            LEFT JOIN   resource_languages      ON resources.language_id            = resource_languages.id
            LEFT JOIN   resource_dd_classes     ON resources.dd_class_id            = resource_dd_classes.id
            LEFT JOIN   resource_dd_divisions   ON resources.dd_devision_id         = resource_dd_divisions.id
            LEFT JOIN   resource_dd_sections    ON resources.dd_section_id          = resource_dd_sections.id
            LEFT JOIN   resource_placements     ON resources.id                     = resource_placements.resource_id
            LEFT JOIN   resource_racks          ON resource_placements.rack_id      = resource_racks.id
            LEFT JOIN   resource_floors         ON resource_placements.floor_id     = resource_floors.id
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_resource_data_all`;
        SQL;
    }
}
