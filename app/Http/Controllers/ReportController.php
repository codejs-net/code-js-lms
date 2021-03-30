<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\resource_category;
use App\Models\resource_type;
use App\Models\resource_creator;
use App\Models\resource_dd_class;
use App\Models\resource_dd_division;
use App\Models\resource_dd_section;
use App\Models\resource_language;
use App\Models\resource_place;
use App\Models\resource_donate;
use App\Models\resource_publisher;
use App\Models\resource;
use App\Models\center;
use App\Models\library;
use App\Models\setting;
use App\Models\view_resource_data;
use App\Models\member;
use App\Models\view_member_data;
use Session;

use App\Exports\ResourceExport;


class ReportController extends Controller
{
    function report_recource(Request $request) {
        try {
        ini_set('max_execution_time', '1200');
        ini_set("pcre.backtrack_limit", "90000000");

        $catg="";$cent="";$type="";

        if($request->catdata=="All"){$catg="%";}
        else{$catg= $request->select_catg;}

        if($request->centerdata=="All"){$cent="%";}
        else{$cent= $request->select_cent;}

        if($request->typedata=="All"){$type="%";}
        else{$type= $request->select_type;}

        $resouredata = view_resource_data::select('*')
        ->where('category_id','LIKE',$catg)
        ->where('center_id','LIKE',$cent)
        ->where('type_id','LIKE',$type)
        ->get()
        ->chunk(600);

        // dd($resouredata[0][0]);
        $pdf = PDF::loadView('reports.rpt_resource',compact('resouredata'),[],
            [
            'format' => 'A4',
            'orientation' => 'L',
            ]);
        return $pdf->stream('resource.pdf');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error','Report genarate Fail.');
        }


    }
    public function export_recource(Request $request) 
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '1200');
        return Excel::download(new ResourceExport($request), 'resource.xlsx');
    }

    public function member_card(Request $request)
    {
        $library = library::first();
        $data = view_member_data::find($request->show_member_id);
        $pdf = PDF::loadView('reports.rpt_member_card',compact('data','library'),[],
            [
            'format' => [85,54],
            ]);
        return $pdf->stream($data->id.'-Member Card.pdf');
    }

    public function member_card_range(Request $request)
    {
        ini_set('max_execution_time', '1200');
        ini_set("pcre.backtrack_limit", "90000000");
        ini_set('memory_limit', '-1');
        $library = library::first();

        $mdata = view_member_data::select('*')
        ->whereBetween('id', [$request->txt_start, $request->txt_end])
        ->get();
        $pdf = PDF::loadView('reports.rpt_member_card_range',compact('mdata','library'),[],
            [
            'format' => [85,54],
            ]);
        return $pdf->stream($request->txt_start.'-'.$request->txt_end.' Member Card.pdf');
    }
}
