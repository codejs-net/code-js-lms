<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $rows_Permission= [

            ['name'=>'user-list','category'=>'User'],
            ['name'=>'user-create','category'=>'User'],
            ['name'=>'user-edit','category'=>'User'],
            ['name'=>'user-delete','category'=>'User'],
            
            ['name'=>'role-list','category'=>'Role'],
            ['name'=>'role-create','category'=>'Role'],
            ['name'=>'role-edit','category'=>'Role'],
            ['name'=>'role-delete','category'=>'Role'],

            ['name'=>'resource-list','category'=>'Resource'],
            ['name'=>'resource-create','category'=>'Resource'],
            ['name'=>'resource-edit','category'=>'Resource'],
            ['name'=>'resource-delete','category'=>'Resource'],

            ['name'=>'member-list','category'=>'Member'],
            ['name'=>'member-create','category'=>'Member'],
            ['name'=>'member-edit','category'=>'Member'],
            ['name'=>'member-delete','category'=>'Member'],

            ['name'=>'support_data-list','category'=>'Support Data'],
            ['name'=>'support_data-create','category'=>'Support Data'],
            ['name'=>'support_data-edit','category'=>'Support Data'],
            ['name'=>'support_data-delete','category'=>'Support Data'],

            ['name'=>'survey-list','category'=>'Survey'],
            ['name'=>'survey-create','category'=>'Survey'],
            ['name'=>'survey-edit','category'=>'Survey'],
            ['name'=>'survey-delete','category'=>'Survey'],

            ['name'=>'lenging-list','category'=>'Lenging'],
            ['name'=>'lenging-create','category'=>'Lenging'],
            ['name'=>'lenging-edit','category'=>'Lenging'],
            ['name'=>'lenging-delete','category'=>'Lenging'],

            ['name'=>'data-import','category'=>'Data Import'],
            ['name'=>'data-export','category'=>'Data Export'],

            ['name'=>'code-genarate','category'=>'Code Genarate'],

            ['name'=>'setting-list','category'=>'Setting'],
            ['name'=>'setting-create','category'=>'Setting'],
            ['name'=>'setting-edit','category'=>'Setting'],
            ['name'=>'setting-delete','category'=>'Setting'],

            ['name'=>'date-change','category'=>'Date Change'],

            ['name'=>'staff-list','category'=>'Staff'],
            ['name'=>'staff-create','category'=>'Staff'],
            ['name'=>'staff-edit','category'=>'Staff'],
            ['name'=>'staff-delete','category'=>'Staff'],
            
        ];
        // Permission::create([$rows_Permission]);
        $insert= DB::table('Permissions')->insert($rows_Permission);
    }
}
