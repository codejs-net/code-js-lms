<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SoapController;
use Illuminate\Support\Facades\DB;
use App\Models\setting;
use App\Models\view_resource_data;
use App\Models\lending_detail;
use App\Models\lending_issue;
use App\Models\lending_return;
use App\Models\lending_config;
use App\Models\view_lending_data;
use App\Models\view_lending_data_all;
use App\Models\center_allocation;
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
                if($request->lending=="issue")
                {
                    $lendingdata = lending_issue::select('lending_issues.*','members.name_si','members.name_ta','members.name_en')
                    ->whereBetween('lending_issues.lending_date', [$request->from_date, $request->to_date])
                    ->leftJoin('members', 'lending_issues.member_id', '=', 'members.id')
                    ->orderBy('lending_issues.updated_at', 'DESC')
                    ->get();
                }
                else if($request->lending=="return")
                {
                    $lendingdata = lending_return::select('lending_returns.*','members.name_si','members.name_ta','members.name_en')
                    ->whereBetween('lending_returns.lending_date', [$request->from_date, $request->to_date])
                    ->leftJoin('members', 'lending_returns.member_id', '=', 'members.id')
                    ->orderBy('lending_returns.updated_at', 'DESC')
                    ->get();
                }
               

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
                $center_array= array();
                $resource_center = center_allocation::where('staff_id', Auth::user()->detail_id)->with(['center'])->get();
                foreach($resource_center as $value)
                {array_push($center_array,$value->center->id);}

                if($request->returnfilter=="All")
                {
                    $lendingdata = view_lending_data_all::select('*')
                    ->whereIn('center_id', $center_array)
                    ->whereBetween('issue_date', [$request->from_date, $request->to_date])
                    ->orwhereBetween('return_date', [$request->from_date, $request->to_date])
                    ->whereIn('center_id', $center_array)
                    ->orderBy('updated_at', 'DESC')
                    ->get(); 
                }
                else if($request->returnfilter=="Non Return")
                {
                    $_return=0;
                    $lendingdata = view_lending_data_all::select('*')
                    ->where('return','LIKE',$_return)
                    ->whereIn('center_id', $center_array)
                    ->whereBetween('issue_date', [$request->from_date, $request->to_date])
                    ->orderBy('updated_at', 'DESC')
                    ->get(); 
                }
                else if($request->returnfilter=="Return")
                {
                    $_return=1;
                    $lendingdata = view_lending_data_all::select('*')
                    ->where('return','LIKE',$_return)
                    ->whereIn('center_id', $center_array)
                    ->whereBetween('return_date', [$request->from_date, $request->to_date])
                    ->orderBy('updated_at', 'DESC')
                    ->get(); 
                }
                else if($request->returnfilter=="Issue")
                {
                    $lendingdata = view_lending_data_all::select('*')
                    ->whereIn('center_id', $center_array)
                    ->whereBetween('issue_date', [$request->from_date, $request->to_date])
                    ->orderBy('updated_at', 'DESC')
                    ->get(); 
                }
                elseif($request->returnfilter=="Late")
                {
                    $_return=0;
                    $lendingdata=array();
                    $_lendingdata = view_lending_data_all::select('*')
                    ->where('return','LIKE',$_return)
                    ->whereIn('center_id', $center_array)
                    ->whereBetween('issue_date', [$request->from_date, $request->to_date])
                    ->whereIn('center_id', $center_array)
                    ->orderBy('updated_at', 'DESC')
                    ->get();
                    // ------------------------
                    $today = Carbon::now();
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

                        ->addColumn('returned_date', function ($data) {
                            if($data->return==1)
                            {$returned_date=$data->return_date;}
                            else
                            {$returned_date= trans('N/A');}
                            return $returned_date;  
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
                                $button .= '<button class="btn btn-sm btn-outline-danger remainder"><i class="fa fa-commenting-o loader_before" ></i><i class="fa fa-spin fa-circle-o-notch loader_after" style="display:none;"></i></</button>';
                            }
                            else
                            {
                                $button  = '<a class="btn btn-sm btn-outline-success mx-1" data-toggle="modal" data-target="#data_show" data-mid="'.$data->id.'"><i class="fa fa-eye" ></i></a>';
                            }
                            return $button;   
                        })

                        ->rawColumns(['to_be_return','returned','returned_date','fine','action'])
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

    public function lending_remainder(Request $request)
    {
        $locale = session()->get('locale');
        $setting = setting::where('setting','locale_db')->first();

        if($setting->value=="0")
        {$lang="_".$locale;}
        else
        {$lang="_".$setting->value;}

        $member="member". $lang;
        $lib_name = "name" . $lang;
        $title = "title" . $lang;
        $reminder = "reminder_msg" . $lang;
        $data = view_lending_data::where('id',$request->lend_detail_id)->first();

        //-------------------SMS Alert-----------------------------
        $SoapController = new SoapController;
        $mobile_no = $data->mobile;
        $issudate = $data->issue_date;
        $to_be_return = $request->to_be_return;
        $lend_member = $data->$member;
        $lend_title = $data->$title;

        $reminder_msg = setting::where('setting',$reminder)->first();
        
        $library = session()->get('library');
        if (!empty($library)) {
            $library_name = $library->$lib_name;
        }
       
        $message_text = $library_name ."-".trans('Reminder')."\r\n \r\n".trans('Member Detail')."-". $lend_member ."(". $data->member_id .")". "\r\n" .trans('Lending Detail')."-". $lend_title. "\r\n" .trans('Issue Date')."-" .$issudate. "\r\n" .trans('To Be Return') ."-". $to_be_return ."\r\n".$reminder_msg->value;
        if($SoapController->is_connected()==true)
        {
            $SoapController->multilang_msg_Send($mobile_no, $message_text);
            $status="success";
        } 
        else
        {$status="notconnect";}
        //-----------------------End SMS Alert----------------------

        return response()->json($status);
    }

}
