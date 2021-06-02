<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;
use App\Models\survey;
use App\Models\lending_detail;
use App\Models\survey_suggestion;
use App\Models\survey_detail_temp; 
use App\Models\view_survey;
use Session;

class Survey_tempExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
            $sdata = view_survey::select('*')
            ->where('survey_id',$survey_id)
            ->where('survey',0)
            ->get();
            foreach ($sdata as $value) 
            {
               
                $lend = lending_detail::select('id')
                ->where('resource_id', $value->resource_id)
                ->Where('return', 0)
                ->first();
                if($lend) 
                {
                    $lend_reso = [
                        'id'   => $value->id,
                        'survey_id' => $value->survey_id,
                        'accessionNo' => $value->accessionNo,
                        'standard_number' => $value->standard_number,
                        'title_si' => $value->title_si,
                        'title_ta' => $value->title_ta,
                        'title_en' => $value->title_en,
                        'category_si' => $value->category_si,
                        'category_ta' => $value->category_ta,
                        'category_en' => $value->category_en,
                        'type_si' => $value->type_si,
                        'type_ta' => $value->type_ta,
                        'type_en' => $value->type_en,
                        'name_si' => $value->name_si,
                        'name_ta' => $value->name_ta,
                        'name_en' => $value->name_en,
                        'price' => $value->price,
                        'phydetails' => $value->phydetails,
                        'center_si' => $value->center_si,
                        'center_ta' => $value->center_ta,
                        'center_en' => $value->center_en,
                        'survey' => $value->survey,
                        'suggestion_si' => $value->suggestion_si,
                        'suggestion_ta' => $value->suggestion_ta,
                        'suggestion_en' => $value->suggestion_en,
    
                        ];
                        $insert_data[] = $lend_reso;
                }
                
            }
            $surveydata = collect($insert_data);

        }
        elseif( $this->request->export_type =="Suggested")
        {
            $surveydata = view_survey::select(
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
                'name_si',
                'name_ta',
                'name_en',
                'price',
                'phydetails',
                'center_si',
                'center_ta',
                'center_en',
                'survey',
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
            $surveydata = view_survey::select(
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
                'name_si',
                'name_ta',
                'name_en',
                'price',
                'phydetails',
                'center_si',
                'center_ta',
                'center_en',
                'survey',
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
            'name_si',
            'name_ta',
            'name_en',
            'price',
            'phydetails',
            'center_si',
            'center_ta',
            'center_en',
            'survey',
            'suggestion_si',
            'suggestion_ta',
            'suggestion_en'
        ];
    }
}
