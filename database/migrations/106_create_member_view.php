<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberView extends Migration
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
            CREATE VIEW view_member_data AS
                SELECT  members.*,
                        member_cats.category_si,
                        member_cats.category_ta,
                        member_cats.category_en,
                        titles.title_si,
                        titles.title_ta,
                        titles.title_en,
                        genders.gender_si,
                        genders.gender_ta,
                        genders.gender_en,
                        member_guarantors.name_si AS guarantor_si,
                        member_guarantors.name_ta AS guarantor_ta,
                        member_guarantors.name_en AS guarantor_en,
                        member_guarantors.nic     AS guarantor_nic,
                        member_guarantors.mobile  AS guarantor_mobile
                FROM    members 
            LEFT JOIN   member_cats         ON members.categoryid   = member_cats.id
            LEFT JOIN   titles              ON members.titleid      = titles.id
            LEFT JOIN   genders             ON members.genderid     = genders.id
            LEFT JOIN   member_guarantors   ON members.guarantor_id = member_guarantors.id
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_member_data`;
        SQL;
    }
}
