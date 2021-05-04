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
use Carbon\Carbon;
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
        if(empty($locale))
        {
            Session::put('locale', 'si');
        }
        $today = Carbon::now()->isoFormat('YYYY-MM-DD');
        // dd($today);
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
            $_issue = lending_detail::select('id')
                ->whereYear('issue_date',$thisyear)
                ->whereMonth('issue_date',$i)
                ->count();
            $_return = lending_detail::select('id')
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
        ->with('r_summary',$_return_summary);

        
    }

    public function latast_lending()
    {
        $latast_issue = view_lending_data::select('resource_id','member_id','accessionNo','title_si','title_ta','title_en','member_si','member_ta','member_en')
        ->orderBy('id', 'DESC')
        ->offset(5)
        ->limit(5)
        ->get();

        $latast_return = view_lending_data::select('resource_id','member_id','accessionNo','title_si','title_ta','title_en','member_si','member_ta','member_en')
        ->where('return',1)
        ->orderBy('id', 'DESC')
        ->offset(5)
        ->limit(5)
        ->get();

        return response()->json(['issue' => $latast_issue,'return' => $latast_return]);
    }

}
