<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;
use App\Models\view_resource_data;
use Session;

class ResourceExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    protected $request;

    function __construct($request) {
            $this->request = $request;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $catg="";$cent="";$type="";

        if($this->request->export_catg=="All"){$catg="%";}
        else{$catg= $this->request->export_catg;}

        if($this->request->export_cent=="All"){$cent="%";}
        else{$cent= $this->request->export_cent;}

        if($this->request->export_type=="All"){$type="%";}
        else{$type= $this->request->export_type;}

        $resouredata = view_resource_data::select(
            'id',
            'accessionNo',
            'standard_number',
            'title_si',
            'title_ta',
            'title_en',
            'category_si',
            'category_ta',
            'category_en',
            'type_si',
            'type_ta',
            'type_en',
            'name_si',
            'name_ta',
            'name_en',
            'publisher_si',
            'publisher_ta',
            'publisher_en',
            'ddc',
            'price',
            'phydetails',
            'center_si',
            'center_ta',
            'center_en'
        )
        ->where('status',1)
        ->where('category_id','LIKE',$catg)
        ->where('center_id','LIKE',$cent)
        ->where('type_id','LIKE',$type)
        ->get();

        return $resouredata;
    
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
            $event->sheet->getDelegate()->getStyle('A1:X1')->applyFromArray($styleArray);
           
            // $event->sheet->getDelegate()->getStyle('A1:D4')->getAlignment()->setWrapText(true);
        },
    ];
}


    public function headings(): array
    {
        return [
            'No',
            'Accession No',
            'Standard Number',
            'Title Si',
            'Title Ta',
            'Title En',
            'Category Si',
            'Category Ta',
            'Category En',
            'Type_si',
            'Type_ta',
            'Type_en',
            'Creator Si',
            'Creator Ta',
            'Creator En',
            'Publisher Si',
            'Publisher Ta',
            'Publisher En',
            'DDC',
            'Price',
            'Physical Details',
            'Library Center Si',
            'Library Center Ta',
            'Library Center En'
        ];
    }
}
