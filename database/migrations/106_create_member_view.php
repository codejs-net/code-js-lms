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
                SELECT  members.id,
                        members.titleid,
                        members.categoryid,
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
                        members.birthday,
                        members.gender,
                        members.description,
                        members.regdate,
                        members.image,
                        members.status,
                        member_cats.category_si,
                        member_cats.category_ta,
                        member_cats.category_en,
                        titles.title_si,
                        titles.title_ta,
                        titles.title_en
                FROM    members 
            LEFT JOIN   member_cats ON members.categoryid = member_cats.id
            LEFT JOIN   titles      ON members.titleid = titles.id
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_member_data`;
        SQL;
    }
}
