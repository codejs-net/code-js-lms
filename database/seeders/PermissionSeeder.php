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
        // $permissions = [
        //    'role-list',
        //    'role-create',
        //    'role-edit',
        //    'role-delete',
        //    'product-list',
        //    'product-create',
        //    'product-edit',
        //    'product-delete',
        //    'code-import',
        //    'code-genarate',
        //    'book-list',
        //    'book-create',
        //    'book-edit',
        //    'book-delete',
        //    'member-list',
        //    'member-create',
        //    'member-edit',
        //    'member-delete',
        //    'member_detail-list',
        //    'member_detail-create',
        //    'member_detail-edit',
        //    'member_detail-delete',
        //    'book_details-list',
        //    'book_details-create',
        //    'book_details-edit',
        //    'book_details-delete',
        // ];
   
        // foreach ($permissions as $permission) {
        //      Permission::create(['name' => $permission]);
        // }

        // -------------------------------------------

        $rows_Permission= [
            ['name'=>'role-list','category'=>'1'],
            ['name'=>'role-create','category'=>'1'],
            ['name'=>'role-edit','category'=>'1'],
            ['name'=>'role-delete','category'=>'1'],
            ['name'=>'product-list','category'=>'2'],
            ['name'=>'product-create','category'=>'2'],
            ['name'=>'product-edit','category'=>'2'],
            ['name'=>'product-delete','category'=>'2'],
            ['name'=>'resource-list','category'=>'3'],
            ['name'=>'resource-create','category'=>'3'],
            ['name'=>'resource-edit','category'=>'3'],
            ['name'=>'resource-delete','category'=>'3'],
            ['name'=>'member-list','category'=>'4'],
            ['name'=>'member-create','category'=>'4'],
            ['name'=>'member-edit','category'=>'4'],
            ['name'=>'member-delete','category'=>'4'],
            ['name'=>'support_data-list','category'=>'5'],
            ['name'=>'support_data-create','category'=>'5'],
            ['name'=>'support_data-edit','category'=>'5'],
            ['name'=>'support_data-delete','category'=>'5'],
            ['name'=>'survey-list','category'=>'7'],
            ['name'=>'survey-create','category'=>'7'],
            ['name'=>'survey-edit','category'=>'7'],
            ['name'=>'survey-delete','category'=>'7'],
            ['name'=>'lenging-list','category'=>'8'],
            ['name'=>'lenging-create','category'=>'8'],
            ['name'=>'lenging-edit','category'=>'8'],
            ['name'=>'lenging-delete','category'=>'8'],
            ['name'=>'data-import','category'=>'9'],
            ['name'=>'data-export','category'=>'9'],
            ['name'=>'code-genarate','category'=>'9'],
            ['name'=>'setting-list','category'=>'10'],
            ['name'=>'setting-create','category'=>'10'],
            ['name'=>'setting-edit','category'=>'10'],
            ['name'=>'setting-delete','category'=>'10']
            
        ];
        // Permission::create([$rows_Permission]);
        $insert= DB::table('Permissions')->insert($rows_Permission);
    }
}
