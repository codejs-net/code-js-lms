<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLendingViewAll extends Migration
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
            CREATE ALGORITHM=UNDEFINED DEFINER=CURRENT_USER() SQL SECURITY DEFINER VIEW view_lending_data_all AS
                SELECT  lending_details.*,
                        resources.accessionNo,
                        resources.standard_number,
                        resources.title_si,
                        resources.title_ta,
                        resources.title_en,
                        resources.category_id,
                        resources.type_id,
                        resources.image,
                        resources.center_id,
                        members.categoryid AS member_categoryid,
                        members.name_si    AS member_si,
                        members.name_ta    AS member_ta,
                        members.name_en    AS member_en,
                        members.address1_si,
                        members.address1_ta,
                        members.address1_en,
                        members.address2_si,
                        members.address2_ta,
                        members.address2_en,
                        members.mobile,
                        members.nic,
                        member_cats.category_si AS member_category_si,
                        member_cats.category_ta AS member_category_ta,
                        member_cats.category_en AS member_category_en,
                        lending_configs.lending_period,
                        resource_categories.category_si,
                        resource_categories.category_ta,
                        resource_categories.category_en,
                        resource_types.type_si,
                        resource_types.type_ta,
                        resource_types.type_en,
                        centers.name_si AS center_si,
                        centers.name_ta AS center_ta,
                        centers.name_en AS center_en,
                        fine_settles.id AS fine_settle
                FROM    lending_details 
            LEFT JOIN   resources           ON lending_details.resource_id  = resources.id
            LEFT JOIN   members             ON lending_details.member_id    = members.id
            LEFT JOIN   member_cats         ON members.categoryid           = member_cats.id
            LEFT JOIN   lending_configs     ON members.categoryid           = lending_configs.categoryid
            LEFT JOIN   resource_categories ON resources.category_id        = resource_categories.id
            LEFT JOIN   resource_types      ON resources.type_id            = resource_types.id
            LEFT JOIN   centers             ON resources.center_id          = centers.id
            LEFT JOIN   fine_settles        ON lending_details.id           = fine_settles.lending_detail_id
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_lending_data_all`;
        SQL;
    }
}
