<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\library;
use App\Models\theme;
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

       
        return view('home.home');
        // $library = library::all();
        // if ($library) {
        //     return view('configuration.create');
        //     //App::abort(404);
        //   }
        // else{
        //     return view('home.home');
        // }
    }

    

   
}
