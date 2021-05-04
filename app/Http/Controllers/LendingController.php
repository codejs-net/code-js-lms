<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\setting;
use App\Models\view_resource_data;
use App\Models\lending_detail;
use App\Models\lending;
use App\Models\lending_config;
use App\Models\view_lending_data;
use App\Models\member;
use Session;
use Carbon\Carbon;
use Auth;

class LendingController extends Controller
{
    public function index(Request $request)
    {
        $locale = session()->get('locale');
        $setting = setting::where('setting','locale_db')->first();

        if($setting->value=="0")
        {$lang="_".$locale;}
        else
        {$lang="_".$setting->value;}

        Session::put('db_locale', $lang);
        $today = Carbon::now()->isoFormat('YYYY-MM-DD');

            if(request()->ajax())
            {
                $_return="";
                if($request->returnfilter=="All"){$_return="%";}
                else{$_return= $request->returnfilter;}

                $lendingdata = view_lending_data::select('*')
                ->where('return','LIKE',$_return)
                ->whereBetween($request->date_type, [$request->from_date, $request->to_date])
                ->orderBy('updated_at', 'DESC')
                ->get();

                return datatables()->of($lendingdata)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                           
                            $button  = '<a class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#data_show" data-mid="'.$data->id.'"><i class="fa fa-eye" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#data_delete" data-mid="'.$data->id.'" data-mname="'.$data->accessionNo.'"><i class="fa fa-trash" ></i></a>';
                            return $button;   
                        })

                        ->addColumn('return', function ($data) {
                            if($data->return==1)
                            {$button = '<label class="btn btn-success btn-sm"><i class="fa fa-check" ></i></label>';}
                            else
                            {$button = '<label class="btn btn-default btn-sm"><i class="fa fa-minus" ></i></label>';}
                            return $button;  
                        })

                        ->rawColumns(['action','return'])
                        ->make(true);
                        
            }
        return view('lending.index')
                ->with('today', $today);
    }

}
