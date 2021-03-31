<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffView extends Migration
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
            CREATE VIEW view_staff_data AS
                SELECT  staff.id,
                        staff.titleid,
                        staff.designetion_id,
                        staff.center_id,
                        staff.name_si,
                        staff.name_ta,
                        staff.name_en,
                        staff.address1_si,
                        staff.address1_ta,
                        staff.address1_en,
                        staff.address2_si,
                        staff.address2_ta,
                        staff.address2_en,
                        staff.nic,
                        staff.mobile,
                        staff.birthday,
                        staff.gender,
                        staff.description,
                        staff.regdate,
                        staff.image,
                        staff.status,
                        designetions.designetion_si,
                        designetions.designetion_ta,
                        designetions.designetion_en,
                        titles.title_si,
                        titles.title_ta,
                        titles.title_en,
                        centers.name_si AS center_si,
                        centers.name_ta AS center_ta,
                        centers.name_en AS center_en
                FROM    staff 
            LEFT JOIN   designetions ON staff.designetion_id = designetions.id
            LEFT JOIN   centers      ON staff.center_id = centers.id
            LEFT JOIN   titles       ON staff.titleid = titles.id
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_staff_data`;
        SQL;
    }
}
