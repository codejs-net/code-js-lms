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
use Session;
use Carbon\Carbon;
use Auth;


class ReturnController extends Controller
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

        $lending_period = setting::where('setting','lending_period')->first();
        Session::put('lending_period', $lending_period->value);

        $fine_rate = setting::where('setting','fine_rate')->first();
        Session::put('fine_rate', $fine_rate->value);

        $returndate=Carbon::now()->isoFormat('YYYY-MM-DD');

        return view('lending.return.index')->with('returndate',$returndate);
    }

    public function get_lending(Request $request)
    {
        $lang = session()->get('db_locale');
        $lending_period = session()->get('lending_period');
        $fine_rate = session()->get('fine_rate');

        $title="title".$lang;  $category="category".$lang;  $type="type".$lang; $member="member".$lang;$address1="address1".$lang; $address2="address2".$lang; $member_="name".$lang;
        $lenddata=array();
        $mbr=member::find($request->memberid);
        if($mbr)
        {
            $lend = view_lending_data::select('*')
                    ->where('member_id', $request->memberid)
                    ->Where('return',0)
                    ->get();
            if($lend->count()!=0)
            {
                for($i=0;$i<$lend->count();$i++)
                {
                    $fine_amount=0;
                    $issudate = Carbon::parse($lend[$i]['issue_date']);
                    $_issudate=Carbon::parse($lend[$i]['issue_date']);
                    $returndate=$issudate->addDays($lending_period)->isoFormat('YYYY-MM-DD');
                   
                    $diff = Carbon::now()->diffInDays($_issudate);
                    if($diff>$lending_period)
                    {
                        $fine_amount=number_format($fine_rate * ($diff-$lending_period),2);
                    }

                    $lenddata[$i]['status']           ="success";
                    $lenddata[$i]['id']               =$lend[$i]['id'];
                    $lenddata[$i]['member_id']        =$lend[$i]['member_id'];
                    $lenddata[$i]['member_name']      =$lend[$i][$member];
                    $lenddata[$i]['member_add1']      =$lend[$i][$address1];
                    $lenddata[$i]['member_add2']      =$lend[$i][$address2];
                    $lenddata[$i]['lending_id']       =$lend[$i]['lendind_id'];
                    $lenddata[$i]['resource_id']      =$lend[$i]['resource_id'];
                    $lenddata[$i]['resource_title']   =$lend[$i][$title];
                    $lenddata[$i]['resource_cat']     =$lend[$i][$category];
                    $lenddata[$i]['resource_type']    =$lend[$i][$type];
                    $lenddata[$i]['resource_accno']   =$lend[$i]['accessionNo'];
                    $lenddata[$i]['resource_isn']     =$lend[$i]['standard_number'];
                    $lenddata[$i]['issue_date']       =$lend[$i]['issue_date'];
                    $lenddata[$i]['return_date']      =$returndate;
                    $lenddata[$i]['return']           =$lend[$i]['return'];
                    $lenddata[$i]['fine_amount']      =$fine_amount;
                    
                }
            }
            else
            {
                $lenddata[0]['status']       ="no";
                $lenddata[0]['member_name']  =$mbr->$member_;
            }     
        }
        else
        {
            $lenddata[0]['status']  ="error";
        }
        return response()->json($lenddata);
        
       
    }

    
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
    public function store_return(Request $request)
    {
        $detail=lending_detail::find($request->cellVal_lend_id);
        if($detail)
        {
            $detail->return=1;
            $detail->return_date=$request->dtereturn;
            $detail->save();
            return response()->json(['massage' => "success",'lendid' =>$request->cellVal_lend_id]);
        }
        else
        {
            return response()->json(['massage' => "error"]);
        }
       
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
    public function return_receipt($id)
    {
        // $lending = lending::where('lending_id',$id )->first();
        $lendingdata = view_lending_data::where('lending_id',$id )->get();
        return view('receipts.issue_receipt')->with('lendingdata',$lendingdata); 
    }
}
