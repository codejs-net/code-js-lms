<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\library;
use App\Models\theme;
use App\Models\resource;
use App\Models\member;
use App\Models\lending_detail;
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

        return view('home.home')
        ->with('rcount',$reso_count)
        ->with('mcount',$mem_count)
        ->with('rtncount',$return_count)
        ->with('issucount',$issue_count);

        
    }


 

   
}
