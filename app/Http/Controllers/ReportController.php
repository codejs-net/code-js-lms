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
use App\Models\member;
use App\Models\lending_detail;
use App\Models\lending_issue;
use App\Models\lending_return;
use App\Models\lending_config;
use App\Models\center_allocation;
use App\Models\view_member_data;
use App\Models\view_resource_data;
use App\Models\view_lending_data;
use App\Models\view_lending_data_all;
use Carbon\Carbon;
use Auth;

use Session;

use App\Exports\ResourceExport;


class ReportController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:resource-report', ['only' => ['resource_index']]);
         $this->middleware('permission:member-report', ['only' => ['index']]);
         $this->middleware('permission:satff-report', ['only' => ['index']]);
         $this->middleware('permission:lending-report', ['only' => ['index']]);
         $this->middleware('permission:resource_support_data-report', ['only' => ['index']]);
         $this->middleware('permission:member_support_data-report', ['only' => ['index']]);
         $this->middleware('permission:staff_support_data-report', ['only' => ['index']]);
         $this->middleware('permission:library_support_data-report', ['only' => ['index']]);
         $this->middleware('permission:receipt-report', ['only' => ['index']]);
         $this->middleware('permission:survey-report', ['only' => ['index']]);
    }

    public function resource_index()
    {
        $resource_center=center::all();
        $categorydata=resource_category::all();
        $languagedata=resource_language::all();
        $publisherdata=resource_publisher::all();
        $creatordata=resource_creator::all();
        $dd_classdata=resource_dd_class::all();
        $dd_devisiondata=resource_dd_division::all();
        $dd_sectiondata=resource_dd_section::all();
        
        return view('reports.resources.index')
        ->with('cat_data',$categorydata)
        ->with('center_data',$resource_center)
        ->with('language_data',$languagedata)
        ->with('publisher_data',$publisherdata)
        ->with('creator_data',$creatordata)
        ->with('ddclass_data',$dd_classdata)
        ->with('dddevision_data',$dd_devisiondata)
        ->with('ddsection_data',$dd_sectiondata);
       
    }
    public function support_index()
    {
        return view('reports.support_data.index');
       
    }
    public function lending_index()
    {
        $today = Carbon::now()->isoFormat('YYYY-MM-DD');
        return view('reports.lending.index')->with('today',$today);
       
    }
    function report_recource(Request $request) {
       
        try {
            ini_set('max_execution_time', '1200');
            ini_set("pcre.backtrack_limit", "90000000");
            ini_set('memory_limit', '-1');

            $resouredata = view_resource_data::select('*')
            ->whereBetween('id', [$request->resource_from, $request->resource_to])
            ->get();
            
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
    function report_recource1(Request $request) {
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
//lending Reports
    function report_lending(Request $request) {
       
        try {
            ini_set('max_execution_time', '1200');
            ini_set("pcre.backtrack_limit", "90000000");
            ini_set('memory_limit', '-1');

            $today = Carbon::now();
            $_return="";
            $rpt_from=$request->rpt_from;
            $rpt_to=$request->rpt_to;
            $rpt_from=$request->rpt_from;
            $rpt_filter=$request->rpt_filter;
            $center_array= array();
            $resource_center = center_allocation::where('staff_id', Auth::user()->detail_id)->with(['center'])->get();
            foreach($resource_center as $value)
            {array_push($center_array,$value->center->id);}

            if($rpt_filter=="All")
            {
                $lendingdata = view_lending_data_all::select('*')
                ->whereIn('center_id', $center_array)
                ->whereBetween('issue_date', [$rpt_from, $rpt_to])
                ->orwhereBetween('return_date', [$rpt_from, $rpt_to])
                ->whereIn('center_id', $center_array)
                ->orderBy('updated_at', 'DESC')
                ->get(); 
            }
            else if($rpt_filter=="Non Return")
            {
                $_return=0;
                $lendingdata = view_lending_data_all::select('*')
                ->where('return','LIKE',$_return)
                ->whereIn('center_id', $center_array)
                ->whereBetween('issue_date', [$rpt_from, $rpt_to])
                ->orderBy('updated_at', 'DESC')
                ->get(); 
            }
            else if($rpt_filter=="Return")
            {
                $_return=1;
                $lendingdata = view_lending_data_all::select('*')
                ->where('return','LIKE',$_return)
                ->whereIn('center_id', $center_array)
                ->whereBetween('return_date', [$rpt_from, $rpt_to])
                ->orderBy('updated_at', 'DESC')
                ->get(); 
            }
            else if($rpt_filter=="Issue")
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
                $lendingdata=array();
                $_lendingdata = view_lending_data_all::select('*')
                ->where('return','LIKE',$_return)
                ->whereIn('center_id', $center_array)
                ->whereBetween('issue_date', [$rpt_from, $rpt_to])
                ->whereIn('center_id', $center_array)
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
                        array_push($lendingdata,$item);
                    }
                }
                // ------------------------
            }
            $pdf = PDF::loadView('reports.lending.rpt_lending',compact('lendingdata','rpt_from','rpt_to','rpt_filter'),[],
                [
                'format' => 'A4',
                'orientation' => 'P',
                ]);
           

            return $pdf->stream($rpt_from.'_'.$rpt_to.'_'.$rpt_filter.'_lending.pdf');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error','Report genarate Fail.');
        }

    }
//end lending Reports
}
