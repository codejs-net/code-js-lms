<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;
use App\Models\resource;
use App\Models\setting;
use App\Models\view_resource_data;
use App\Models\lending_detail;
use App\Models\lending_issue;
use App\Models\lending_config;
use App\Models\view_lending_data;
use App\Models\center_allocation;
use App\Http\Controllers\SoapController;
use Session;
use Carbon\Carbon;
use Auth;
use System;
use App\Models\User;
use App\Models\staff;


class IssueController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Lenging-issue', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locale = session()->get('locale');
        $db_setting = setting::where('setting', 'locale_db')->first();
        if ($db_setting->value == "0") {
            $lang = "_" . $locale;
        } else {
            $lang = "_" . $db_setting->value;
        }
        Session::put('db_locale', $lang);
        $issuedate = Carbon::now()->isoFormat('YYYY-MM-DD');

        // $lending_period = setting::where('setting', 'lending_period')->first();
        // Session::put('lending_period', $lending_period->value);
        // error_log($issuedate);
        // $lending_setting = setting::where('setting', 'lending_count')->first();
        // Session::put('lending_limit', $lending_setting->value);
        return view('lending.issue.index')->with('issuedate', $issuedate);
    }

    public function memberview(Request $request)
    {
        
        $lang = session()->get('db_locale');

        $address1 = "address1" . $lang;
        $address2 = "address2" . $lang;
        $title="title".$lang;  
        $category="category".$lang;  
        $type="type".$lang; 
        $member="name".$lang;
        $status="";
        $lenddata=array();

        $mbr = member::find($request->memberid);
        if($mbr)
        {
            $lending_config = lending_config::where('categoryid',$mbr->categoryid)->first();
            $finerate = setting::where('setting','fine_rate')->first();
            $lending_period = $lending_config->lending_period;
            $lending_limit = $lending_config->lending_limit;
            Session::put('lending_period', $lending_config->lending_period);
            Session::put('lending_limit', $lending_config->lending_limit);
            
            $lend = view_lending_data::select('*')
                ->where('member_id', $mbr->id)
                ->Where('return', 0)
                ->get();

            // ------------------------
            if($lend->count()!=0)
            {
                $status="success";
                
                for($i=0;$i<$lend->count();$i++)
                {
                    $fine_amount=0; 
                    $fine_settle="N/A";
                    $fine_rate = $finerate->value;
                    $issudate = Carbon::parse($lend[$i]['issue_date']);
                    $issudate_ = Carbon::parse($lend[$i]['issue_date']);
                    $returndate=$issudate->addDays($lending_period)->isoFormat('YYYY-MM-DD');
                    $nowdate = Carbon::parse($request->dteissue);
                    $diff =  $nowdate->diffInDays($issudate_);

                    if($lend[$i]['fine_settle']=="")
                    {
                        if($diff>$lending_period)
                        {
                            $fine_amount=number_format($fine_rate * ($diff-$lending_period),2);
                            $fine_settle="unsettled";
                        }
                    }
                    else
                    { 
                        $fine_amount=$lend[$i]['fine_amount'];
                        $fine_settle="settled";
                    }
                
                    $lenddata[$i]['id']               =$lend[$i]['id'];
                    $lenddata[$i]['lending_id']       =$lend[$i]['lending_id'];
                    $lenddata[$i]['resource_id']      =$lend[$i]['resource_id'];
                    $lenddata[$i]['resource_title']   =$lend[$i][$title];
                    $lenddata[$i]['resource_cat']     =$lend[$i][$category];
                    $lenddata[$i]['resource_type']    =$lend[$i][$type];
                    $lenddata[$i]['resource_accno']   =$lend[$i]['accessionNo'];
                    $lenddata[$i]['image']            =$lend[$i]['image'];
                    $lenddata[$i]['resource_isn']     =$lend[$i]['standard_number'];
                    $lenddata[$i]['issue_date']       =$lend[$i]['issue_date'];
                    $lenddata[$i]['return_date']      =$returndate;
                    $lenddata[$i]['return']           =$lend[$i]['return'];
                    $lenddata[$i]['fine_amount']      =$fine_amount;
                    $lenddata[$i]['fine_settle']      =$fine_settle; 
                }
                return response()->json(['lend_data'=>$lenddata,
                'status'=>$status,
                'member_nme' => $mbr->$member, 
                'member_id' => $mbr->id, 
                'member_adds1' => $mbr->$address1, 
                'member_adds2' => $mbr->$address2, 
                'mobile' => $mbr->mobile, 
                'db_count' => $lend->count(), 
                'lending_limit' => $lending_limit]);
            }
            else
            {
                $status  ="no";
                return response()->json(['status'=>$status,
                'member_nme' => $mbr->$member, 
                'member_id' => $mbr->id, 
                'member_adds1' => $mbr->$address1, 
                'member_adds2' => $mbr->$address2, 
                'mobile' => $mbr->mobile, 
                'db_count' => $lend->count(), 
                'lending_limit' => $lending_limit]);
            }  
        } 
        else
        {
            $status  ="error";
            return response()->json(['status'=>$status]);
        }  
        // ------------------------
    }

    public function resourceview(Request $request)
    {
        $lang = session()->get('db_locale');
        $lending_limit = session()->get('lending_limit');
        $title = "title" . $lang;
        $category = "category" . $lang;
        $type = "type" . $lang;
        $creator = "name" . $lang;
        $center_array= array();


        $loguser = User::where('id', Auth::user()->id)->first();
        $resource_center = center_allocation::where('staff_id', $loguser->detail_id)
        ->with(['center'])
        ->get();

        foreach($resource_center as $value)
        {
            array_push($center_array,$value->center->id);
        }

        $reso = view_resource_data::select('*')
            ->where('status', '1')
            ->whereIn('center_id', $center_array)
            ->where('accessionNo', $request->resourceinput)
            ->orWhere('standard_number', $request->resourceinput)
            ->where('status', '1')
            ->whereIn('center_id', $center_array)
            ->get();
        if ($reso->count()>0) {
            if ($reso->count()==1) {
                $lend = lending_detail::select('*')
                ->where('resource_id', $reso[0]->id)
                ->Where('return', 0)
                ->first();
                if (!$lend) {
                    return response()->json([
                        'id' => $reso[0]->id,
                        'title' => $reso[0]->$title,
                        'accno' => $reso[0]->accessionNo,
                        'snumber' => $reso[0]->standard_number,
                        'category' => $reso[0]->$category,
                        'type' => $reso[0]->$type,
                        'creator' => $reso[0]->$creator,
                        'massage' => "success"
                    ]);
                } 
                else {
                    return response()->json(['massage' => "lend"]);
                }
            }
            else{
                // ---------same isbn------------
                return response()->json(['resos'=>$reso,'massage' => "duplicate"]);
            }

        } 
        else {
            return response()->json(['massage' => "error"]);
        }
    }

    public function select_resource_view(Request $request)
    {
        $lang = session()->get('db_locale');
        $title = "title" . $lang;
        $category = "category" . $lang;
        $type = "type" . $lang;
        $creator = "name" . $lang;
        $center_array= array();

       
        $loguser = User::where('id', Auth::user()->id)->first();
        $resource_center = center_allocation::where('staff_id', $loguser->detail_id)
        ->with(['center'])
        ->get();
        foreach($resource_center as $value)
        {
            array_push($center_array,$value->center->id);
        }

        $reso = view_resource_data::select('*')
            ->where('id', $request->select_resoid)
            ->Where('status', '1')
            ->whereIn('center_id', $center_array)
            ->first();
        if ($reso) {
            $lend = lending_detail::select('*')
            ->where('resource_id', $reso->id)
            ->Where('return', 0)
            ->first();
            if (!$lend) {
                return response()->json([
                    'id' => $reso->id,
                    'title' => $reso->$title,
                    'accno' => $reso->accessionNo,
                    'snumber' => $reso->standard_number,
                    'category' => $reso->$category,
                    'type' => $reso->$type,
                    'creator' => $reso->$creator,
                    'massage' => "success"
                ]);
            } 
            else {
                return response()->json(['massage' => "lend"]);
            }
        } 
        else {
            return response()->json(['massage' => "error"]);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lang = session()->get('db_locale');
        $lending_period = session()->get('lending_period');
        $lib_name = "name" . $lang;

        $lend = new lending_issue;
        $lend->member_id     =  $request->mem_id;
        $lend->description   =  $request->description;
        $lend->issue_date    =  $request->dteissue;

        $lend->save();
        //-------------------SMS Alert-----------------------------
        $SoapController = new SoapController;
        $mobile_no = $request->membermobile;
        $issudate = Carbon::parse($lend->issue_date);
        $returndate = $issudate->addDays($lending_period)->isoFormat('YYYY-MM-DD');

        $library = session()->get('library');
        if (!empty($library)) {
            $library_name = $library->$lib_name;
        }

        if ($lang == "_si") {
            $message_text = $library_name . "-බැහැර දීම්\r\n \r\n" . "සාමාජික විස්තර -" . $request->membername . "(" . $lend->member_id . ")" . "\r\n" . "බැහැර දීම් විස්තර - " . $request->description . "\r\n" . "බැහැර දුන් දිනය - " . $lend->issue_date . "\r\n" . "ආපසු භාරදිය යුතු දිනය - " . $returndate . "\r\n" . "ස්තූතියි!";
        } elseif ($lang == "_en") {
            $message_text = $library_name . "\r\n" . "සාමාජික විස්තර - (" . $lend->member_id . ")" . $request->membername . "\r\n" . "බැහැර දීම් විස්තර - " . $request->description . "\r\n" . "බැහැර දුන් දිනය - " . $lend->issue_date . "\r\n" . "ආපසු භාරදිය යුතු දිනය - " . $returndate . "\r\n" . "ස්තූතියි!";
        } else {
            $message_text = $library_name . "\r\n" . "සාමාජික විස්තර - (" . $lend->member_id . ")" . $request->membername . "\r\n" . "බැහැර දීම් විස්තර - " . $request->description . "\r\n" . "බැහැර දුන් දිනය - " . $lend->issue_date . "\r\n" . "ආපසු භාරදිය යුතු දිනය - " . $returndate . "\r\n" . "ස්තූතියි!";
        }
        $setting_sms_send = setting::where('setting', 'sms_issue')->first();
        if ($setting_sms_send->value == "1") 
        {
            if($SoapController->is_connected()==true)
            {$SoapController->multilang_msg_Send($mobile_no, $message_text);} 
        } 
        
        //-----------------------End SMS Alert----------------------

        return response()->json(['lend_id' => $lend->id,'return_date' => $returndate]);
    }

    public function store_issue(Request $request)
    {
        $lend = new lending_detail;
        // $issudate = Carbon::parse($request->dteissue);
        // $returndate=$issudate->addDays(14);

        $lend->lending_issue_id  =  $request->lendid;
        $lend->member_id         =  $request->mem_id;
        $lend->resource_id       =  $request->resourceid;
        $lend->issue_date        =  $request->dteissue;
        $lend->return            =  0;
        $lend->fine_amount       =  0;
        $lend->issue_by          =  Auth::user()->id;

        $lend->save();

        return response()->json(['massage' => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function issue_receipt($id)
    {
        // $lending = lending::where('lending_id',$id )->first();
        $lendingdata = view_lending_data::where('lending_issue_id', $id)->get();
        return view('receipts.issue_receipt')->with('lendingdata', $lendingdata);
    }

}
