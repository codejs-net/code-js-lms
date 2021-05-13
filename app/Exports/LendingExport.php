<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;
use App\Models\center_allocation;
use App\Models\view_lending_data;
use App\Models\view_lending_data_all;
use Carbon\Carbon;
use Auth;
use Session;

class LendingExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        $type="type".$lang;
        $center="center".$lang;
        $title="title".$lang;
        $member="member".$lang;
        $member_category="member_category".$lang;

        $today = Carbon::now();
        $_return="";
        $rpt_from=$this->request->rpt_from;
        $rpt_to=$this->request->rpt_to;
        $rpt_filter=$this->request->rpt_filter;
        $center_array= array();
        $resource_center = center_allocation::where('staff_id', Auth::user()->detail_id)->with(['center'])->get();
        foreach($resource_center as $value)
        {array_push($center_array,$value->center->id);}

        if($rpt_filter=="All")
        {
            $lendingdata = view_lending_data_all::select(
                'id',
                'issue_date',
                'accessionNo',
                'standard_number',
                $title,
                'member_id',
                $member,
                'return_date',
                'fine_amount',
                $center,
                $member_category
            )
            ->whereIn('center_id', $center_array)
            ->whereBetween('issue_date', [$rpt_from, $rpt_to])
            ->orwhereBetween('return_date', [$rpt_from, $rpt_to])
            ->whereIn('center_id', $center_array)
            ->orderBy('updated_at', 'DESC')
            ->get(); 
        }
        elseif($rpt_filter=="Non Return")
        {
            $_return=0;
            $lendingdata = view_lending_data_all::select( 
                'id',
                'issue_date',
                'accessionNo',
                'standard_number',
                $title,
                'member_id',
                $member,
                'return_date',
                'fine_amount',
                $center,
                $member_category
            )
            ->where('return','LIKE',$_return)
            ->whereIn('center_id', $center_array)
            ->whereBetween('issue_date', [$rpt_from, $rpt_to])
            ->orderBy('updated_at', 'DESC')
            ->get(); 
        }
        elseif($rpt_filter=="Return")
        {
            $_return=1;
            $lendingdata = view_lending_data_all::select(
                'id',
                'issue_date',
                'accessionNo',
                'standard_number',
                $title,
                'member_id',
                $member,
                'return_date',
                'fine_amount',
                $center,
                $member_category
            )
            ->where('return','LIKE',$_return)
            ->whereIn('center_id', $center_array)
            ->whereBetween('return_date', [$rpt_from, $rpt_to])
            ->orderBy('updated_at', 'DESC')
            ->get(); 
        }
        elseif($rpt_filter=="Issue")
        {
            $lendingdata = view_lending_data_all::select('*')
            ->whereIn('center_id', $center_array)
            ->whereBetween('issue_date', [$rpt_from, $rpt_to])
            ->orderBy('updated_at', 'DESC')
            ->get(); 
        }
        elseif($rpt_filter=="Late")
        {
            $_return=0;
            $lendingdata_array=array();
            $_lendingdata = view_lending_data_all::select('*')
            ->where('return','LIKE',$_return)
            ->whereIn('center_id', $center_array)
            ->whereBetween('issue_date', [$rpt_from, $rpt_to])
            ->orderBy('updated_at', 'DESC')
            ->get();
            // ------------------------
            foreach( $_lendingdata as $item)
            {
                $lending_period = $item->lending_period;
                $issudate = Carbon::parse($item->issue_date);
                $diff =  $today->diffInDays($issudate);

                if($diff>$lending_period)
                {
                    array_push($lendingdata_array,$item);
                }
            }
            $lendingdata = collect($lendingdata_array);
            // ------------------------
        }
        return $lendingdata;
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
            'id',
            'Issue date',
            'AccessionNo',
            'Standard number',
            'Title',
            'Member id',
            'Member',
            'Returned date',
            'Fine_amount',
            'center',
            'Member_category_en'
        ];
    }
}
