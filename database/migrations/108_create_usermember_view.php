<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsermemberView extends Migration
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
            CREATE ALGORITHM=UNDEFINED DEFINER=CURRENT_USER() SQL SECURITY DEFINER VIEW view_usermember_data AS
                SELECT  users.*,
                        members.name_si,
                        members.name_ta,
                        members.name_en,
                        members.address1_si,
                        members.address1_ta,
                        members.address1_en,
                        members.address2_si,
                        members.address2_ta,
                        members.address2_en,
                        members.nic,
                        members.mobile,
                        members.image
                 FROM   users 
            LEFT JOIN   members ON users.detail_id= members.id
                WHERE   users.user_type='member' 
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_usermember_data`;
        SQL;
    }
}
