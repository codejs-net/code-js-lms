<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserstaffView extends Migration
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
            CREATE ALGORITHM=UNDEFINED DEFINER=CURRENT_USER() SQL SECURITY DEFINER VIEW view_userstaff_data AS
                SELECT  users.*,
                        staff.name_si,
                        staff.name_ta,
                        staff.name_en,
                        staff.address1_si,
                        staff.address1_ta,
                        staff.address1_en,
                        staff.address2_si,
                        staff.address2_ta,
                        staff.address2_en,
                        staff.designetion_id,
                        staff.nic,
                        staff.mobile,
                        staff.image,
                        designetions.designetion_si,
                        designetions.designetion_ta,
                        designetions.designetion_en
                 FROM   users 
            LEFT JOIN   staff ON users.detail_id= staff.id
            LEFT JOIN   designetions ON staff.designetion_id= designetions.id
                WHERE   users.user_type='staff' 
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_userstaff_data`;
        SQL;
    }
}
