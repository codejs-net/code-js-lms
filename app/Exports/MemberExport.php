<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;
use App\Models\view_member_data;
use Session;

class MemberExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    // protected $request;

    // function __construct($request) {
    //         $this->request = $request;
    // }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        $memberdata = view_member_data::select(
            'regnumber',
            'regdate',
            'title_si',
            'title_ta',
            'title_en',
            'category_si',
            'category_ta',
            'category_en',
            'name_si',
            'name_ta',
            'name_en',
            'address1_si',
            'address1_ta',
            'address1_en',
            'address2_si',
            'address2_ta',
            'address2_en',
            'nic',
            'mobile',
            'birthday',
            'guarantor_si',
            'guarantor_ta',
            'guarantor_en',
            'occupation_si',
            'occupation_ta',
            'occupation_en',
            'Workplace_si',
            'Workplace_ta',
            'Workplace_en'
        )
        ->where('status',1)
        ->orderBy('regnumber', 'DESC')
        ->get();

        return $memberdata;
    
    }

    public function registerEvents(): array
{
    return [
        AfterSheet::class    => function(AfterSheet $event) {
            
            $event->sheet->getDelegate()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            $event->sheet->getDelegate()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
            // $event->sheet->getDelegate()->getStyle(1)->getFont()->setSize(14);
            $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);
            // $event->$sheet->row(1, function($row) { $row->setBackground('#CCCCCC'); });

            $styleArray = [
                // 'borders' => [
                //     'outline' => [
                //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                //         'Background' => ['argb' => '#010101'],
                //         ]
                //     ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => '020405']
                    ],
                    'font' => [
                        // 'name'      =>  'Calibri',
                        'size'      =>  12,
                        'bold'      =>  true,
                        'color' => ['argb' => 'fefefe'],
                    ],
            ];
            $event->sheet->getDelegate()->getStyle('A1:AC1')->applyFromArray($styleArray);
           
            // $event->sheet->getDelegate()->getStyle('A1:D4')->getAlignment()->setWrapText(true);
        },
    ];
}


    public function headings(): array
    {
        return [
            'regnumber',
            'regdate',
            'Title si',
            'Title ta',
            'Title en',
            'Category si',
            'Category ta',
            'Category en',
            'Name si',
            'Name ta',
            'Name en',
            'Address1 si',
            'Address1 ta',
            'Address1 en',
            'Address2 si',
            'Address2 ta',
            'Address2 en',
            'NIC',
            'Mobile',
            'Birthday',
            'Guarantor si',
            'Guarantor ta',
            'Guarantor en',
            'Occupation si',
            'Occupation ta',
            'Occupation en',
            'Workplace si',
            'Workplace ta',
            'Workplace en'
        ];
    }
}
