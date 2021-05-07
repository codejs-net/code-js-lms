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
use App\Models\view_lending_data_all;
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
        $fine_rate = setting::where('setting','fine_rate')->first();
        Session::put('fine_rate', $fine_rate->value);

            if(request()->ajax())
            {
                $_return="";
                if($request->returnfilter=="All"){$_return="%";}
                else{$_return= $request->returnfilter;}

                $lendingdata = view_lending_data_all::select('*')
                ->where('return','LIKE',$_return)
                ->whereBetween($request->date_type, [$request->from_date, $request->to_date])
                ->orderBy('updated_at', 'DESC')
                ->get();

                return datatables()->of($lendingdata)
                        ->addIndexColumn()
        
                        ->addColumn('to_be_return', function ($data) {
                            $lending_period = $data->lending_period;
                            $issudate = Carbon::parse($data->issue_date);
                            $to_be_return=$issudate->addDays($lending_period)->isoFormat('YYYY-MM-DD');
                            return $to_be_return;  
                           
                        })

                        ->addColumn('returned', function ($data) {
                            if($data->return==1)
                            {$button = '<label class="text-success"><i class="fa fa-check" ></i></label>';}
                            else
                            {$button = '<label class="text-dark"><i class="fa fa-minus" ></i></label>';}
                            return $button;  
                        })
                        ->addColumn('fine', function ($data) {
                            $today = Carbon::now();
                            $fine_rate = session()->get('fine_rate');
                            $lending_period = $data->lending_period;
                            $issudate = Carbon::parse($data->issue_date);
                            $diff =  $today->diffInDays($issudate);

                            if($diff>$lending_period && $data->return==0)
                            {
                                $fine_amount=number_format($fine_rate* ($diff-$lending_period),2);
                            }
                            else
                            {
                                $fine_amount=number_format($data->fine_amount,2);
                            }

                            return $fine_amount;  
                        })
                        ->addColumn('action', function($data){
                            $today = Carbon::now();
                            $lending_period = $data->lending_period;
                            $issudate = Carbon::parse($data->issue_date);
                            $diff =  $today->diffInDays($issudate);

                            if($diff>$lending_period && $data->return==0)
                            {
                                $button  = '<a class="btn btn-sm btn-outline-success mx-1" data-toggle="modal" data-target="#data_show" data-mid="'.$data->id.'"><i class="fa fa-eye" ></i></a>';
                                $button .= '<a href="" class="btn btn-sm btn-outline-danger"><i class="fa fa-commenting-o" ></i></a>';
                            }
                            else
                            {
                                $button  = '<a class="btn btn-sm btn-outline-success mx-1" data-toggle="modal" data-target="#data_show" data-mid="'.$data->id.'"><i class="fa fa-eye" ></i></a>';
                            }
                            return $button;   
                        })

                        ->rawColumns(['to_be_return','returned','fine','action'])
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
