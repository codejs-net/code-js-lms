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

class Lending_accountExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        $rpt_member="";
        $rpt_resource="";
        $rpt_filter=$this->request->rpt_filter_account;

        if($this->request->rpt_member=="All"){$rpt_member="%";}
        else{ $rpt_member=$this->request->rpt_member;}

        if($this->request->rpt_resource=="All"){$rpt_resource="%";}
        else{ $rpt_resource=strtoupper($this->request->rpt_resource);}

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
            ->where('member_id','LIKE',$rpt_member)
            ->where('accessionNo','LIKE',$rpt_resource)
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
            ->where('member_id','LIKE',$rpt_member)
            ->where('accessionNo','LIKE',$rpt_resource)
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
            ->where('member_id','LIKE',$rpt_member)
            ->where('accessionNo','LIKE',$rpt_resource)
            ->orderBy('updated_at', 'DESC')
            ->get(); 
        }
        elseif($rpt_filter=="Issue")
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
            ->where('member_id','LIKE',$rpt_member)
            ->where('accessionNo','LIKE',$rpt_resource)
            ->orderBy('updated_at', 'DESC')
            ->get(); 
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
            $event->sheet->getDelegate()->getStyle('A1:K1')->applyFromArray($styleArray);
           
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
            'Fine amount',
            'center',
            'Member category'
        ];
    }
}
