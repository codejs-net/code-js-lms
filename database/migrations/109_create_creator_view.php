<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatorView extends Migration
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
            CREATE ALGORITHM=UNDEFINED DEFINER=CURRENT_USER() SQL SECURITY DEFINER VIEW view_creator_data AS
                SELECT  resource_creators.*,
                        titles.title_si,
                        titles.title_ta,
                        titles.title_en,
                        genders.gender_si,
                        genders.gender_ta,
                        genders.gender_en
                FROM    resource_creators 
            LEFT JOIN   titles              ON resource_creators.titleid      = titles.id
            LEFT JOIN   genders             ON resource_creators.genderid     = genders.id
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_creator_data`;
        SQL;
    }
}
