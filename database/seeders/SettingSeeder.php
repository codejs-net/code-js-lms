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
        ],
        [  
        'setting'=>'lending_count',
        'category'=>'2',
        'value'=>'2',
        'detail'=>'Limit of tha Resources lending in one Job]'
        ]
    ];
    $insert= DB::table('settings')->insert($mul_rows_settings);

    }
}
