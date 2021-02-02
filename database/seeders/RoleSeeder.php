<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::create([
        // 	'staff_id' => '1', 
        //     'email' => 'shanuka.pvt@gmail.com',
        //     'username' => 'shanuka',
        // 	'password' => bcrypt('5151050')
        // ]);
  
        $role = Role::create(['name' => 'Admin']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        // $user->assignRole([$role->id]);
    }
}
