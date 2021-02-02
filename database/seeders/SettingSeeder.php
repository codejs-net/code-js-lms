<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mul_rows_settings= [
            
        [  
        'setting'=>'locale_db',
        'category'=>'1',
        'value'=>'0',
        'detail'=>'db details show according to locale'
        ]    
    ];
    $insert= DB::table('settings')->insert($mul_rows_settings);

    }
}
