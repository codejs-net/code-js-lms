<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserView extends Migration
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
            CREATE VIEW view_user_data AS
            SELECT  users.id,
                    users.username,
                    users.email,
                    staff.name_si,
                    staff.name_ta,
                    staff.name_en
            FROM    users 
            JOIN    staff 
            ON      users.staff_id = staff.id
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `view_user_data`;
        SQL;
    }
}
