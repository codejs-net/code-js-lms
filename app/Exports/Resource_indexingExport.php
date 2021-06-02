<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\DB;
use App\Models\view_resource_data;
use App\Models\view_resource_data_all;
use App\Models\center_allocation;
use Auth;
use Session;

class Resource_indexingExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        $locale = session()->get('locale');
        $lang="_".$locale;
        $category="category".$lang;
        $type="type".$lang;
        $center="center".$lang;
        $publisher="publisher".$lang;
        $title="title".$lang;
        $creator1="name".$lang;
        $creator2="name2".$lang;
        $creator3="name3".$lang;
        $language="language".$lang;
        $dd_class="class".$lang;
        $dd_devision="devision".$lang;
        $dd_section="section".$lang;
        
        $center_array= array();
        $resource_center = center_allocation::where('staff_id', Auth::user()->detail_id)->with(['center'])->get();
        foreach($resource_center as $value)
        {
            array_push($center_array,$value->center->id);
        }

        $rpt_from=$this->request->resource_from;
        $rpt_to=$this->request->resource_to;
        $rpt_order=$this->request->resource_order;

        $resouredata = view_resource_data_all::select(
            'id',
            'accessionNo',
            'standard_number',
            $title,
            $category,
            $type,
            $creator1,
            $creator2,
            $creator3,
            'cretor_more',
            $publisher,
            $dd_class,
            $dd_devision,
            $dd_section,
            'ddc',
            'price',
            'phydetails',
            'purchase_date',
            'edition',
            'publishyear',
            $center
        )
        ->where('status',1)
        ->whereIn('center_id', $center_array)
        ->skip($rpt_from)
        ->take($rpt_to-$rpt_from)
        ->orderBy($rpt_order, 'ASC')
        ->get();

        $list = [];
        foreach ($resouredata as $key => $value) {
            $creator=$value[$creator1];
            $creator.=($value[$creator2] !=null)?"/".$value[$creator2]:"";
            $creator.=($value[$creator3] !=null)?"/".$value[$creator3]:"";
            $creator.=($value['cretor_more'] =="1")?",".trans('more...'):"";

            $list[] = [
                'id'                =>$value['id'],
                'accessionNo'       =>$value['accessionNo'],
                'standard_number'   =>$value['standard_number'],
                'Title'             =>$value[$title],
                'category'          =>$value[$category],
                'type'              =>$value[$type],
                'creator'           =>$creator,
                'publisher'         =>$value[$publisher],
                'dd_class'          =>$value['dd_class'],
                'dd_devision'       =>$value['dd_devision'],
                'dd_section'        =>$value['dd_section'],
                'ddc'               =>$value['ddc'],
                'price'             =>$value['price'],
                'phydetails'        =>$value['phydetails'],
                'purchase_date'     =>$value['purchase_date'],
                'edition'           =>$value['edition'],
                'publishyear'       =>$value['publishyear'],
                'center'            =>$value[$center]
            ];
        }

        return collect($list);
    
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
            $event->sheet->getDelegate()->getStyle('A1:R1')->applyFromArray($styleArray);
           
            // $event->sheet->getDelegate()->getStyle('A1:D4')->getAlignment()->setWrapText(true);
        },
    ];
}


    public function headings(): array
    {
        return [
            'Id',
            'AccessionNo',
            'Standard_number',
            'Title',
            'Category',
            'Type',
            'Creator/Author',
            'Publisher',
            'DD class',
            'DD devision',
            'DD section',
            'DDC',
            'Price',
            'Phydetails',
            'Purchase Date',
            'Edition',
            'Publish Year',
            'Center'
        ];
    }
}
