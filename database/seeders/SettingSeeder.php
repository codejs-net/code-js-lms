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
        'setting'=>'locale',
        'category'=>'1',
        'value'=>'si',
        'detail'=>'display Language'
        ],
        [  
        'setting'=>'lending_period',
        'category'=>'2',
        'value'=>'14',
        'detail'=>'Number Of Days to Return Resource'
        ],
        [  
        'setting'=>'fine_rate',
        'category'=>'2',
        'value'=>'2.00',
        'detail'=>'fine rate per Day'
        ],
        [  
        'setting'=>'lending_count',
        'category'=>'2',
        'value'=>'2',
        'detail'=>'Limit of tha Resources lending in one Job'
        ],
        [  
        'setting'=>'default_password',
        'category'=>'3',
        'value'=>'code-js',
        'detail'=>'Default Password For user Account'
        ],
        [  
        'setting'=>'sms_member_create',
        'category'=>'4',
        'value'=>'1',
        'detail'=>'Send SMS on Member Add'
        ],
        [  
        'setting'=>'sms_user_create',
        'category'=>'4',
        'value'=>'1',
        'detail'=>'Send SMS on User Add'
        ],
        [  
        'setting'=>'sms_issue',
        'category'=>'4',
        'value'=>'1',
        'detail'=>'Send SMS on Resuorce Issue'
        ],
        [  
        'setting'=>'sms_return',
        'category'=>'4',
        'value'=>'1',
        'detail'=>'Send SMS on Resource Return'
        ],
        [  
        'setting'=>'email_user_create',
        'category'=>'5',
        'value'=>'1',
        'detail'=>'Send email on User Add'
        ],
        [  
        'setting'=>'email_member_create',
        'category'=>'5',
        'value'=>'1',
        'detail'=>'Send email on Member Add'
        ],
        [  
        'setting'=>'email_issue',
        'category'=>'5',
        'value'=>'1',
        'detail'=>'Send email on Resuorce Issue'
        ],
        [  
        'setting'=>'email_return',
        'category'=>'5',
        'value'=>'1',
        'detail'=>'Send email on Resource Return'
        ],
        [  
        'setting'=>'default_theme',
        'category'=>'6',
        'value'=>'js-blue-dark',
        'detail'=>'Defalut Active Theme'
        ]
       
    ];
    $insert= DB::table('settings')->insert($mul_rows_settings);

    }
}
