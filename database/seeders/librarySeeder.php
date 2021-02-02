<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class librarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mul_rows_library= [
            
            [  
            'name_si'=>'Code-JS',
            'name_ta'=>'',
            'name_en'=>'',
            'address1_si'=>'Rajagiriya',
            'address1_ta'=>'',
            'address1_en'=>'',
            'address2_si'=>'',
            'address2_ta'=>'',
            'address2_en'=>'',
            'telephone'=>'',
            'fax'=>'',
            'email'=>'support@code-js.net'
            ]
           
    ];
    $insert= DB::table('libraries')->insert($mul_rows_library);

    // -----------------------------------------------------------------
        $mul_rows_center= [
                
            [  
            'library_id'=>'1',
            'name_si'=>'Code-JS',
            'name_ta'=>'',
            'name_en'=>'',
            'address1_si'=>'Rajagiriya',
            'address1_ta'=>'',
            'address1_en'=>'',
            'address2_si'=>'',
            'address2_ta'=>'',
            'address2_en'=>'',
            'telephone'=>'',
            'fax'=>'',
            'email'=>'support@code-js.net'
            ]
        
    ];
    $insert= DB::table('centers')->insert($mul_rows_center);

// -----------------------------------------------------------------
    }
}
