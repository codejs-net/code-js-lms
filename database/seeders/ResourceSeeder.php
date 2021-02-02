<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mul_rows_book_cat= [
            
            ['category_si'=>'N/A'],
            ['category_si'=>'Art'],
            ['category_si'=>'Science'],
            ['category_si'=>'Buddist'],
            ['category_si'=>'Other']
        
        ];
        $insert= DB::table('book_cats')->insert($mul_rows_book_cat);
        // -----------------------------------------------------------------
        $mul_rows_book_pub= [
                    
            ['publisher_si'=>'N/A'],
            ['publisher_si'=>'Gunasena'],
            ['publisher_si'=>'Wasana'],
            ['publisher_si'=>'Malpiyali'],
            ['publisher_si'=>'Codejs']
        
        ];
        $insert= DB::table('book_publishers')->insert($mul_rows_book_pub);
        // --------------------------------------------------------------
        $mul_rows_book_lang= [
                    
            ['language_si'=>'N/A'],
            ['language_si'=>'Sinhala'],
            ['language_si'=>'English'],
            ['language_si'=>'Tamil'],
            ['language_si'=>'Hindi']
        
        ];
        $insert= DB::table('book_langs')->insert($mul_rows_book_lang);
        
        // --------------------------------------------------------------
        $mul_rows_book_physical= [
                    
            ['phymedia_si'=>'N/A'],
            ['phymedia_si'=>'Paper'],
            ['phymedia_si'=>'CD'],
            ['phymedia_si'=>'DVD'],
            
        
        ];
        $insert= DB::table('book_media')->insert($mul_rows_book_physical);
        // --------------------------------------------------------------
        $mul_rows_book_dd_class= [
                    
            ['class_code'=>'000','class_si'=>'Computer science, information']
            
        ];
        $insert= DB::table('book_dd_classes')->insert($mul_rows_book_dd_class);
        //--------------------------------------------------------------
        $mul_rows_book_dd_devision= [
                    
            [
            'devision_code'=>'000',
            'dd_class_id'=>'1',
            'devision_si'=>'Computer science, knowledge & systems'
            ]
            
        ];
        $insert= DB::table('book_dd_devisions')->insert($mul_rows_book_dd_devision);
        //--------------------------------------------------------------
        $mul_rows_book_dd_section= [
                    
            [
            'section_code'=>'000',
            'dd_devision_id'=>'1',
            'section_si'=>'Computer science, information & general works'
            ]
            
        ];
        $insert= DB::table('book_dd_sections')->insert($mul_rows_book_dd_section);
        //--------------------------------------------------------------

        $mul_rows_books= [
            
            [  
            'accessionNo'=>'123456',
            'isbn'=>'554661211',
            'book_title_si'=>'Computer basic',
            'authors_si'=>'Iroshan premarathna',
            'book_category_id'=>'1',
            'language_id'=>'1',
            'publisher_id'=>'1',
            'phymedium_id'=>'1',
            'dd_class_id'=>'1',
            'dd_devision_id'=>'1',
            'dd_section_id'=>'1',
            'center_id'=>'1',
            'purchase_date'=>'2019-12-01',
            'edition'=>'1',
            'price'=>'250',
            'publishyear'=>'2019',
            'phydetails'=>'120 pages',
            'rackno'=>'1',
            'rowno'=>'A',
            'note'=>'Love Poem',
            'br_qr_code'=>'bar_code'
            ]
           
    ];
    $insert= DB::table('books')->insert($mul_rows_books);

    // -----------------------------------------------------------------

    }
}
