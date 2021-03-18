<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyView extends Migration
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
            CREATE VIEW view_survey AS
                SELECT  survey_detail_temps.*,
                        resources.accessionNo,
                        resources.standard_number,
                        resources.category_id,
                        resources.type_id,
                        resources.center_id,
                        resources.publisher_id,
                        resources.image,
                        resources.title_si,
                        resources.title_ta,
                        resources.title_en,
                        resources.ddc,
                        resources.price,
                        resources.phydetails,
                        survey_suggestions.suggestion_si,
                        survey_suggestions.suggestion_ta,
                        survey_suggestions.suggestion_en,
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
                        centers.name_si AS center_si,
                        centers.name_ta AS center_ta,
                        centers.name_en AS center_en
                FROM    survey_detail_temps
            LEFT JOIN   resources           ON survey_detail_temps.resource_id = resources.id
            LEFT JOIN   survey_suggestions  ON survey_detail_temps.suggestion_id = survey_suggestions.id
            LEFT JOIN   resource_categories ON resources.category_id = resource_categories.id
            LEFT JOIN   resource_types      ON resources.type_id = resource_types.id
            LEFT JOIN   resource_creators   ON resources.cretor_id = resource_creators.id
            LEFT JOIN   resource_publishers ON resources.publisher_id = resource_publishers.id
            LEFT JOIN   centers             ON resources.center_id = centers.id
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_survey`;
        SQL;
    }
}
