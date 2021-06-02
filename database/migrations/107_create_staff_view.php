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
                SELECT  staff.*,
                        designetions.designetion_si,
                        designetions.designetion_ta,
                        designetions.designetion_en,
                        titles.title_si,
                        titles.title_ta,
                        titles.title_en,
                        genders.gender_si,
                        genders.gender_ta,
                        genders.gender_en
                FROM    staff 
            LEFT JOIN   designetions ON staff.designetion_id= designetions.id
            LEFT JOIN   titles       ON staff.titleid       = titles.id
            LEFT JOIN   genders      ON staff.genderid      = genders.id
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_staff_data`;
        SQL;
    }
}
