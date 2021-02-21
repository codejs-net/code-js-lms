<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;
use App\Models\resource;
use App\Models\setting;
use App\Models\view_resource_data;
use App\Models\lending_detail;
use App\Models\lending;
use App\Models\view_lending_data;
use App\Http\Controllers\SoapController;
use Session;
use Carbon\Carbon;
use Auth;


class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locale = session()->get('locale');
        $db_setting = setting::where('setting','locale_db')->first();
        if($db_setting->value=="0"){$lang="_".$locale;}
        else{$lang="_".$db_setting->value;}
        Session::put('db_locale', $lang);

        $issuedate=Carbon::now()->isoFormat('YYYY-MM-DD');
        // error_log($issuedate);

        $lending_setting = setting::where('setting','lending_count')->first();
        Session::put('lending_limit', $lending_setting->value);
        return view('lending.issue.index')->with('lending_setting',$lending_setting)->with('issuedate',$issuedate);
    }
    
    public function memberview(Request $request)
    {
        $lang = session()->get('db_locale');

        $name="name".$lang;  $address1="address1".$lang;  $address2="address2".$lang;

        $mbr=member::find($request->memberid);
        $lendm = view_lending_data::select('*')
        ->where('member_id', $request->memberid)
        ->Where('return',0)
        ->get();
        // error_log("----count-------". $lendm->count());
        // return response()->json($data);
        return response()->json(['member_nme' => $mbr->$name,'member_id'=>$mbr->id,'member_adds1'=>$mbr->$address1,'member_adds2'=>$mbr->$address2,'mobile'=>$mbr->mobile,'db_count'=>$lendm->count()]);   
    }

    public function resourceview(Request $request)
    {
        $lang = session()->get('db_locale');
        $lending_limit = session()->get('lending_limit');
        $title="title".$lang;  $category="category".$lang;  $type="type".$lang; $creator="name".$lang;

        $reso = view_resource_data::select('*')
                ->where('status','1')
                ->where('accessionNo', $request->resourceinput)
                ->orWhere('standard_number',$request->resourceinput)
                ->first();
        if($reso)
        {
            $lend = lending_detail::select('*')
            ->where('resource_id', $reso->id)
            ->Where('return',0)
            ->first();
            if(!$lend)
            {
                return response()->json(['id' => $reso->id,
                'title' => $reso->$title,
                'accno'=>$reso->accessionNo,
                'snumber'=>$reso->standard_number,
                'category'=>$reso->$category,
                'type'=>$reso->$type,
                'creator'=>$reso->$creator,
                'massage' => "success"]);   
            }
            else
            {return response()->json(['massage' => "lend"]);}
        }
        else 
        {return response()->json(['massage' => "error"]);}

        
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

        $lend=new lending;
        $lend->member_id     =  $request->mem_id;
        $lend->description   =  $request->description;
        $lend->issue_date    =  $request->dteissue;

        $lend->save();

        $SoapController =new SoapController;
        $mobile_no=$request->membermobile;
        if($lang=="_si"){
            $message_text=$request->membername." ඔබ විසින් ලබාගත් ".$request->description."පුස්ථකාල සම්පත් ";
        }
        elseif($lang=="_en"){

        }
        else{

        }
        $SoapController->multilang_msg_Send($mobile_no,$message_text);

        return response()->json(['lend_id' => $lend->id]);
    }

    public function store_issue(Request $request)
    {
        $lend=new lending_detail;
        // $issudate = Carbon::parse($request->dteissue);
        // $returndate=$issudate->addDays(14);

        $lend->lending_id     =  $request->lendid;
        $lend->member_id      =  $request->mem_id;
        $lend->resource_id    =  $request->resourceid;
        $lend->issue_date     =  $request->dteissue;
        $lend->return         =  0;
        $lend->fine_amount    =  0;
        $lend->issue_by       =  Auth::user()->id;

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
        $lendingdata = view_lending_data::where('lending_id',$id )->get();
        return view('receipts.issue_receipt')->with('lendingdata',$lendingdata); 
    }
}
