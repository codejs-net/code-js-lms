<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;
use App\Models\survey;
use App\Models\survey_detail; 
use Session;

class Survey_historyExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        $survey_id="";$export_type="";$surveydata=[];

        $survey_id= $this->request->survey_id;

        if($this->request->export_type=="All"){$export_type="%";}
        else{$export_type= $this->request->export_type;}

        if( $this->request->export_type =="Lend")
        {
            $surveydata = survey_detail::select(
                'id',
                'survey_id',
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
                'cretor_name_si',
                'cretor_name_ta',
                'cretor_name_en',
                'price',
                'phydetails',
                'center_name_si',
                'center_name_ta',
                'center_name_en',
                'survey',
                'lend',
                'suggestion_si',
                'suggestion_ta',
                'suggestion_en'
            )
            ->where('survey_id',$survey_id)
            ->where('lend',1)
            ->get();

        }
        elseif( $this->request->export_type =="Suggested")
        {
            $surveydata = survey_detail::select(
                'id',
                'survey_id',
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
                'cretor_name_si',
                'cretor_name_ta',
                'cretor_name_en',
                'price',
                'phydetails',
                'center_name_si',
                'center_name_ta',
                'center_name_en',
                'survey',
                'lend',
                'suggestion_si',
                'suggestion_ta',
                'suggestion_en'
            )
            ->where('survey_id',$survey_id)
            ->where('survey',1)
            ->whereNotNull('suggestion_id')
            ->get();
        }
       else
        {
            $surveydata = survey_detail::select(
                'id',
                'survey_id',
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
                'cretor_name_si',
                'cretor_name_ta',
                'cretor_name_en',
                'price',
                'phydetails',
                'center_name_si',
                'center_name_ta',
                'center_name_en',
                'survey',
                'lend',
                'suggestion_si',
                'suggestion_ta',
                'suggestion_en'
            )
            ->where('survey_id',$survey_id)
            ->where('survey','LIKE',$export_type)
            ->get();
        }
       
        return $surveydata;
    
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
            $event->sheet->getDelegate()->getStyle('A1:Y1')->applyFromArray($styleArray);
           
            // $event->sheet->getDelegate()->getStyle('A1:D4')->getAlignment()->setWrapText(true);
        },
    ];
    }


    public function headings(): array
    {
        return [
            'id',
            'survey_id',
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
            'cretor_name_si',
            'cretor_name_ta',
            'cretor_name_en',
            'price',
            'phydetails',
            'center_name_si',
            'center_name_ta',
            'center_name_en',
            'survey',
            'lend',
            'suggestion_si',
            'suggestion_ta',
            'suggestion_en'
        ];
    }
}
