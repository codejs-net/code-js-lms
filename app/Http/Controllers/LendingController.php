<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\setting;
use Illuminate\Support\Facades\DB;
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
    function __construct()
    {
         $this->middleware('permission:lenging-list|lenging-delete', ['only' => ['index','lending_history','show']]);
         $this->middleware('permission:lenging-delete', ['only' => ['delete']]);
    }

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
       
        // dd($lendingdata);
            if(request()->ajax())
            {
                $lendingdata = lending::select('lendings.*','members.name_si','members.name_ta','members.name_en')
                ->whereBetween('lendings.issue_date', [$request->from_date, $request->to_date])
                ->leftJoin('members', 'lendings.member_id', '=', 'members.id')
                ->orderBy('lendings.updated_at', 'DESC')
                ->get();

                return datatables()->of($lendingdata)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                           
                            $button  = '<a class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#data_show" data-mid="'.$data->id.'"><i class="fa fa-eye" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#data_delete" data-mid="'.$data->id.'" data-mname="'.$data->description.'"><i class="fa fa-trash" ></i></a>';
                            return $button;   
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                        
            }
        return view('lending.index')
                ->with('today', $today);
    }
    public function lending_history(Request $request)
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
                            // $button .= '<a class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#data_delete" data-mid="'.$data->id.'" data-mname="'.$data->accessionNo.'"><i class="fa fa-trash" ></i></a>';
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
        return view('lending.history')
                ->with('today', $today);
    }

    public function show(Request $request)
    {
        $data = view_lending_data::where('lending_id',$request->lend_id)->get();
        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $lend=lending::find($request->delete_id);
        $lend_detail = lending_detail::where('lending_id',$lend->id)->get();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $lend->delete();
        foreach ($lend_detail as $data) {
            $data->delete();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->back()->with('success','Lending Recorde Removed successfully.');
    }

}
