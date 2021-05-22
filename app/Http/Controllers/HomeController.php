<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\library;
use App\Models\theme;
use App\Models\resource;
use App\Models\member;
use App\Models\receipt;
use App\Models\lending_detail;
use App\Models\view_lending_data;
use App\Models\view_lending_data_all;
use App\Models\center_allocation;
use App\Models\setting;
use Carbon\Carbon;
use Artisan;
use system;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $lib = library::first();
        $library = session()->get('library');
        if(empty($library))
        {
            Session::put('library', $lib);
        }

        $locale = session()->get('locale');
        $db_setting = setting::where('setting', 'locale_db')->first();
        if ($db_setting->value == "0") {
            $lang = "_" . $locale;
        } else {
            $lang = "_" . $db_setting->value;
        }
        Session::put('db_locale', $lang);
        if(empty($locale))
        {
            Session::put('locale', 'si');
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

        if(auth()->user()->can('dashboard'))
        {
           
            $today = Carbon::now()->isoFormat('YYYY-MM-DD');
            $reso_count = resource::where('status',1)->count();
            $mem_count = member::where('status',1)->count();
            $issue_count = lending_detail::where('issue_date',$today)->count();
            $return_count = lending_detail::where('return_date',$today)->count();
            $income = receipt::where('receipt_date',$today)->sum('payment');
    
            // -----------summary chart--------------------------------
            $issue_summary= array();
            $return_summary= array();
            // $thismonth = Carbon::now()->month();
            $thisyear = Carbon::now()->isoFormat('YYYY');
            for($i=1;$i<=12;$i++)
            {
                $_issue = view_lending_data::select('id')
                    ->whereIn('center_id', $center_array)
                    ->whereYear('issue_date',$thisyear)
                    ->whereMonth('issue_date',$i)
                    ->count();
                $_return = view_lending_data::select('id')
                    ->whereIn('center_id', $center_array)
                    ->where('return',1)
                    ->whereYear('return_date',$thisyear)
                    ->whereMonth('return_date',$i)
                    ->count();
                array_push($issue_summary,$_issue);
                array_push($return_summary,$_return);
            }
            $_issue_summary = implode(',',$issue_summary);
            $_return_summary = implode(',',$return_summary);
            //----------end Summary Chart-----------------------------
            return view('home.home')
            ->with('rcount',$reso_count)
            ->with('mcount',$mem_count)
            ->with('rtncount',$return_count)
            ->with('issucount',$issue_count)
            ->with('income',$income)
            ->with('i_summary',$_issue_summary)
            ->with('r_summary',$_return_summary)
            ->with('cent_name',$center_name_array);
        }     
        else
        {
            return view('resources.catelog')->with('cent_name',$center_name_array);
        } 
    }

    public function latast_lending()
    {
        $latast_issue = view_lending_data::select('resource_id','member_id','accessionNo','title_si','title_ta','title_en','member_si','member_ta','member_en')
        ->orderBy('updated_at', 'DESC')
        ->take(5)
        ->get();

        $latast_return = view_lending_data::select('resource_id','member_id','accessionNo','title_si','title_ta','title_en','member_si','member_ta','member_en')
        ->where('return',1)
        ->take(5)
        ->orderBy('updated_at', 'DESC')
        ->get();

        return response()->json(['issue' => $latast_issue,'return' => $latast_return]);
    }

    public function backup_db()
    {
        // Artisan::call('backup:run --only-db');
        Artisan::call('backup:run',['--only-db' => true]);
        // Artisan::queue('backup:run', ['--only-db' => true]);
        return redirect()->back()->with('success','DB Dump created successfully.');
    }

}
