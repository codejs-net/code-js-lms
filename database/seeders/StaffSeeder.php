<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mul_rows_desig= [
        
        [  
        'designetion_si'=>'librarian',
        'designetion_ta'=>'librarian',
        'designetion_en'=>'librarian'
        ]

    ];
    $insert= DB::table('designetions')->insert($mul_rows_desig);
       
    $mul_rows_staff= [
        
        [  
        'title'=>'Mr',
        'name_si'=>'Shanuka Alahakoon',
        'name_ta'=>'',
        'name_en'=>'',
        'address1_si'=>'Kegalle',
        'address1_ta'=>'',
        'address1_en'=>'',
        'address2_si'=>'',
        'address2_ta'=>'',
        'address2_en'=>'',
        'designetion_id'=>'1',
        'nic'=>'910053094V',
        'mobile'=>'94715151050',
        'birthday'=>'1991-1-5',
        'gender'=>'Male',
        'description'=>'',
        'regdate'=>'2021-1-1',
        'image'=>''
        ]


    ];
    $insert= DB::table('staff')->insert($mul_rows_staff);
    }
}
