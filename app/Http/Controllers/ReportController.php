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
use App\Exports\ResourceExport;
use App\Exports\LendingExport;
use Session;




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
    
    function report_recource(Request $request) {
       
        try {
            ini_set('max_execution_time', '1200');
            ini_set("pcre.backtrack_limit", "90000000");
            ini_set('memory_limit', '-1');

            $locale = session()->get('locale');
            $db_setting = setting::where('setting', 'locale_db')->first();
            if ($db_setting->value == "0") {
                $lang = "_" . $locale;
            } else {
                $lang = "_" . $db_setting->value;
            }
            $center_array= array();
            $center_name_array= array();
            $center_names="name".$lang;
            $resource_center = center_allocation::where('staff_id', Auth::user()->detail_id)->with(['center'])->get();
            foreach($resource_center as $value)
            {
                array_push($center_array,$value->center->id);
                array_push($center_name_array,$value->center->$center_names);
            }
            $rpt_from=$request->resource_from;
            $rpt_to=$request->resource_to;
            $resouredata = view_resource_data::select('*')
            ->whereBetween('id', [$request->resource_from, $request->resource_to])
            ->whereIn('center_id', $center_array)
            ->get();
            
            $pdf = PDF::loadView('reports.resources.rpt_resource',compact('resouredata','rpt_from','rpt_to','center_name_array'),[],
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
    function report_recource_filter(Request $request) {
        
        try {
        ini_set('max_execution_time', '1200');
        ini_set("pcre.backtrack_limit", "90000000");

        $locale = session()->get('locale');
        $db_setting = setting::where('setting', 'locale_db')->first();
        if ($db_setting->value == "0") {
            $lang = "_" . $locale;
        } else {
            $lang = "_" . $db_setting->value;
        }
        $rpt_center="name".$lang;
        $rpt_category="category".$lang;
        $rpt_type="type".$lang;

        $catg="%";
        $type="%";
        $cent= $request->select_cent;

        $rpt_catg="All";
        $rpt_typ="All";
        $rpt_cent = (center::select($rpt_center)->where('id',$request->select_cent)->first())->$rpt_center;
        // dd($rpt_cent);

        if($request->select_catg!="All")
        {
            $catg= $request->select_catg;
            $rpt_catg = (resource_category::select($rpt_category)->where('id',$request->select_catg)->first())->$rpt_category;
        }

        if($request->select_type!="All")
        {
            $type= $request->select_type;
            $rpt_typ = (resource_type::select($rpt_type)->where('id',$request->select_type)->first())->$rpt_type;
        }

       
        $resouredata = view_resource_data::select('*')
                ->where('category_id','LIKE',$catg)
                ->where('center_id',$cent)
                ->where('type_id','LIKE',$type)
                ->get();
                // ->chunk(600);

        $pdf = PDF::loadView('reports.resources.rpt_resource_filter',compact('resouredata','rpt_cent','rpt_catg','rpt_typ'),[],
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
    public function lending_index()
    {
        
        $today = Carbon::now()->isoFormat('YYYY-MM-DD');
        $memberdata=member::select('id','name_si','name_ta','name_en')->get();
        return view('reports.lending.index')->with('today',$today)->with('memberdata',$memberdata);
       
    }

    function report_lending(Request $request) {
       
        try {
            ini_set('max_execution_time', '1200');
            ini_set("pcre.backtrack_limit", "90000000");
            ini_set('memory_limit', '-1');

            $today = Carbon::now();
            $_return="";
            $rpt_from=$request->rpt_from;
            $rpt_to=$request->rpt_to;
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
            elseif($rpt_filter=="Non Return")
            {
                $_return=0;
                $lendingdata = view_lending_data_all::select('*')
                ->where('return','LIKE',$_return)
                ->whereIn('center_id', $center_array)
                ->whereBetween('issue_date', [$rpt_from, $rpt_to])
                ->orderBy('updated_at', 'DESC')
                ->get(); 
            }
            elseif($rpt_filter=="Return")
            {
                $_return=1;
                $lendingdata = view_lending_data_all::select('*')
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

    function report_lending_account(Request $request) {
       
        // try {
            ini_set('max_execution_time', '1200');
            ini_set("pcre.backtrack_limit", "90000000");
            ini_set('memory_limit', '-1');

            $rpt_member="";
            $rpt_resource="";
            $rpt_filter=$request->rpt_filter_account;

            if($request->rpt_member=="All"){$rpt_member="%";}
            else{ $rpt_member=$request->rpt_member;}

            if($request->rpt_resource=="All"){$rpt_resource="%";}
            else{ $rpt_resource=strtoupper($request->rpt_resource);}

            $center_array= array();
            $resource_center = center_allocation::where('staff_id', Auth::user()->detail_id)->with(['center'])->get();
            foreach($resource_center as $value)
            {array_push($center_array,$value->center->id);}

            if($rpt_filter=="All")
            {
                $lendingdata = view_lending_data_all::select('*')
                ->whereIn('center_id', $center_array)
                ->where('member_id','LIKE',$rpt_member)
                ->where('accessionNo','LIKE',$rpt_resource)
                ->orderBy('updated_at', 'DESC')
                ->get(); 
            }
           
            elseif($rpt_filter=="Return")
            {
                $_return=1;
                $lendingdata = view_lending_data_all::select('*')
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
                $lendingdata = view_lending_data_all::select('*')
                ->where('return','LIKE',$_return)
                ->whereIn('center_id', $center_array)
                ->where('member_id','LIKE',$rpt_member)
                ->where('accessionNo','LIKE',$rpt_resource)
                ->orderBy('updated_at', 'DESC')
                ->get(); 
            }
            elseif($rpt_filter=="Issue")
            {
                $lendingdata = view_lending_data_all::select('*')
                ->whereIn('center_id', $center_array)
                ->where('member_id','LIKE',$rpt_member)
                ->where('accessionNo','LIKE',$rpt_resource)
                ->orderBy('updated_at', 'DESC')
                ->get(); 
            }
           
            $pdf = PDF::loadView('reports.lending.rpt_lending_account',compact('lendingdata','rpt_member','rpt_resource','rpt_filter'),[],
                [
                'format' => 'A4',
                'orientation' => 'P',
                ]);
           

            return $pdf->stream($rpt_member.'_'.$rpt_resource.'_'.$rpt_filter.'_lending_account.pdf');
        // }
        // catch (\Exception $e) {
        //     return redirect()->back()->with('error','Report genarate Fail.');
        // }

    }

    public function export_lending(Request $request) 
    {
        try {
            ini_set('memory_limit', '-1');
            ini_set('max_execution_time', '1200');
            return Excel::download(new lendingExport($request), 'lending.xlsx');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error','Report Export Fail.');
        }

    }

//end lending Reports
}
