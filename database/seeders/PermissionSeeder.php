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
            ['name'=>'resource-catalogue','category'=>'Resource'],
            ['name'=>'resource-create','category'=>'Resource'],
            ['name'=>'resource-edit','category'=>'Resource'],
            ['name'=>'resource-delete','category'=>'Resource'],
            ['name'=>'resource-import','category'=>'Resource'],

            ['name'=>'member-list','category'=>'Member'],
            ['name'=>'member-create','category'=>'Member'],
            ['name'=>'member-edit','category'=>'Member'],
            ['name'=>'member-delete','category'=>'Member'],
            ['name'=>'member-import','category'=>'Member'],

            ['name'=>'staff-list','category'=>'Staff'],
            ['name'=>'staff-create','category'=>'Staff'],
            ['name'=>'staff-edit','category'=>'Staff'],
            ['name'=>'staff-delete','category'=>'Staff'],
            ['name'=>'staff-import','category'=>'Staff'],

            ['name'=>'library_support_data-list','category'=>'Support Data'],
            ['name'=>'library_support_data-create','category'=>'Support Data'],
            ['name'=>'library_support_data-edit','category'=>'Support Data'],
            ['name'=>'library_support_data-delete','category'=>'Support Data'],
            ['name'=>'library_support_data-import','category'=>'Support Data'],

            ['name'=>'member_support_data-list','category'=>'Support Data'],
            ['name'=>'member_support_data-create','category'=>'Support Data'],
            ['name'=>'member_support_data-edit','category'=>'Support Data'],
            ['name'=>'member_support_data-delete','category'=>'Support Data'],
            ['name'=>'member_support_data-import','category'=>'Support Data'],

            ['name'=>'staff_support_data-list','category'=>'Support Data'],
            ['name'=>'staff_support_data-create','category'=>'Support Data'],
            ['name'=>'staff_support_data-edit','category'=>'Support Data'],
            ['name'=>'staff_support_data-delete','category'=>'Support Data'],
            ['name'=>'staff_support_data-import','category'=>'Support Data'],

            ['name'=>'resource_support_data-list','category'=>'Support Data'],
            ['name'=>'resource_support_data-create','category'=>'Support Data'],
            ['name'=>'resource_support_data-edit','category'=>'Support Data'],
            ['name'=>'resource_support_data-delete','category'=>'Support Data'],
            ['name'=>'resource_support_data-import','category'=>'Support Data'],

            ['name'=>'survey-list','category'=>'Survey'],
            ['name'=>'survey-create','category'=>'Survey'],
            ['name'=>'survey-edit','category'=>'Survey'],
            ['name'=>'survey-finalize','category'=>'Survey'],
            ['name'=>'survey-unfinalize','category'=>'Survey'],
            ['name'=>'survey-delete','category'=>'Survey'],

            ['name'=>'Lenging-issue','category'=>'Lenging'],
            ['name'=>'Lenging-return','category'=>'Lenging'],
            ['name'=>'lenging-list','category'=>'Lenging'],
            ['name'=>'lenging-delete','category'=>'Lenging'],
            ['name'=>'date-change','category'=>'Lenging'],

            ['name'=>'receipt-list','category'=>'Receipt'],
            ['name'=>'receipt-create','category'=>'Receipt'],
            ['name'=>'receipt-edit','category'=>'Receipt'],
            ['name'=>'receipt-delete','category'=>'Receipt'],

            ['name'=>'center-list','category'=>'Center'],
            ['name'=>'center-create','category'=>'Center'],
            ['name'=>'center-edit','category'=>'Center'],
            ['name'=>'center-delete','category'=>'Center'],

            ['name'=>'basic_setting-list','category'=>'Setting'],
            ['name'=>'basic_setting-edit','category'=>'Setting'],

            ['name'=>'lms_setting-list','category'=>'Setting'],
            ['name'=>'lms_setting-edit','category'=>'Setting'],

            ['name'=>'notification_setting-list','category'=>'Setting'],
            ['name'=>'notification_setting-edit','category'=>'Setting'],

            ['name'=>'lending_setting-list','category'=>'Setting'],
            ['name'=>'lending_setting-edit','category'=>'Setting'],

            ['name'=>'resource-report','category'=>'report'],
            ['name'=>'member-report','category'=>'report'],
            ['name'=>'satff-report','category'=>'report'],
            ['name'=>'lending-report','category'=>'report'],
            ['name'=>'resource_support_data-report','category'=>'report'],
            ['name'=>'member_support_data-report','category'=>'report'],
            ['name'=>'staff_support_data-report','category'=>'report'],
            ['name'=>'library_support_data-report','category'=>'report'],
            ['name'=>'receipt-report','category'=>'report'],
            ['name'=>'survey-report','category'=>'report'],
            ['name'=>'user-report','category'=>'report'],
            ['name'=>'log-report','category'=>'report'],

            ['name'=>'activity-log','category'=>'Activity log'],

            ['name'=>'code-genarate','category'=>'Code Genarate'],

            ['name'=>'dashboard','category'=>'Dashboard'],

            ['name'=>'backup','category'=>'backup'],
            ['name'=>'restore','category'=>'backup'],
            
        ];
        // Permission::create([$rows_Permission]);
        $insert= DB::table('Permissions')->insert($rows_Permission);
    }
}
