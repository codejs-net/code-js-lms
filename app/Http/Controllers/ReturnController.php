<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;
use App\Models\resource;
use App\Models\setting;
use App\Models\view_resource_data;
use App\Models\lending_detail;
use App\Models\lending;
use App\Models\lending_config;
use App\Models\view_lending_data;
use App\Models\fine_settle;
use App\Models\receipt;
use App\Models\receipt_detail;
use App\Http\Controllers\SoapController;
use Session;
use Carbon\Carbon;
use Auth;


class ReturnController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:Lenging-return', ['only' => ['index']]);
    }

    public function index()
    {
        $locale = session()->get('locale');
        $db_setting = setting::where('setting','locale_db')->first();
        if($db_setting->value=="0"){$lang="_".$locale;}
        else{$lang="_".$db_setting->value;}
        Session::put('db_locale', $lang);

       
        // $lending_period = setting::where('setting','lending_period')->first();
        // Session::put('lending_period', $lending_period->value);

        $fine_rate = setting::where('setting','fine_rate')->first();
        Session::put('fine_rate', $fine_rate->value);

        $returndate=Carbon::now()->isoFormat('YYYY-MM-DD');

        return view('lending.return.index')->with('returndate',$returndate);
    }

    public function get_lending(Request $request)
    {
        $lang = session()->get('db_locale');
        $fine_rate = session()->get('fine_rate');

        $title="title".$lang;  $category="category".$lang;  $type="type".$lang; $member="member".$lang;$address1="address1".$lang; $address2="address2".$lang; $member_="name".$lang;
        $lenddata=array();
        $mbr=member::find($request->memberid);

        $lending_config = lending_config::where('categoryid',$mbr->categoryid)->first();
        Session::put('lending_period', $lending_config->lending_period);
        $lending_period = $lending_config->lending_period;
        
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
                    $nowdate = Carbon::parse($request->dtereturn);
                    $diff =  $nowdate->diffInDays($_issudate);

                    if($diff>$lending_period)
                    {
                        $fine_amount=number_format($fine_rate * ($diff-$lending_period),2);
                    }
                    else
                    {
                        $fine_amount=number_format(0.00,2);
                    }


                    $lenddata[$i]['status']           ="success";
                    $lenddata[$i]['id']               =$lend[$i]['id'];
                    $lenddata[$i]['member_id']        =$lend[$i]['member_id'];
                    $lenddata[$i]['member_name']      =$lend[$i][$member];
                    $lenddata[$i]['member_add1']      =$lend[$i][$address1];
                    $lenddata[$i]['member_add2']      =$lend[$i][$address2];
                    $lenddata[$i]['mobile']           =$lend[$i]['mobile'];
                    $lenddata[$i]['lending_id']       =$lend[$i]['lendind_id'];
                    $lenddata[$i]['resource_id']      =$lend[$i]['resource_id'];
                    $lenddata[$i]['resource_title']   =$lend[$i][$title];
                    $lenddata[$i]['resource_cat']     =$lend[$i][$category];
                    $lenddata[$i]['resource_type']    =$lend[$i][$type];
                    $lenddata[$i]['resource_accno']   =$lend[$i]['accessionNo'];
                    $lenddata[$i]['resource_isn']     =$lend[$i]['standard_number'];
                    $lenddata[$i]['image']            =$lend[$i]['image'];
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

    
    public function settle_fine(Request $request)
    {
        $settle=new fine_settle;
        $receiptid=$request->receipt_id;
      
        $settle->lending_detail_id  =$request->lend_id;
        $settle->settlement_type    =$request->settlement_type;
        $settle->settlement_date    =$request->date_settle;
        $settle->receipt_id         =$receiptid;
        $settle->description_si     =$request->discrtpt_si;
        $settle->description_ta     =$request->discrtpt_ta;
        $settle->description_en     =$request->discrtpt_en;
        $settle->save();

        // -----------receipt details----------------------
        $receipt =new receipt_detail;
        $receipt->receipt_id        =$request->receipt_id;
        $receipt->item              =$request->accno;
        $receipt->quentity          =1;
        $receipt->price             =$request->fine_amount;
        $receipt->amount            =$request->fine_amount;
        $receipt->save();
        // ------------------------------------------------

        
        // $detail=lending_detail::find($request->lend_id);

        // if($request->methord=="1") //settle
        // {
        //     $detail->fine_amount    =$request->fine_amount;
        //     $detail->save();
        // }
        // else if($request->methord=="2") //settle and extend
        // {

        //     $detail->fine_amount    =$request->fine_amount;
        //     $detail->return         =1;
        //     $detail->return_date    =$request->date_settle;
        //     $detail->return_by      =Auth::user()->id;
        //     $detail->save();

        //     $lend=new lending;
        //     $lend->member_id        =  $detail->member_id;
        //     $lend->description      =  $request->accno;
        //     $lend->issue_date       =  $request->date_settle;
        //     $lend->save();

        //     $lendd=new lending_detail;
        //     $lendd->lending_id     =  $lend->id;
        //     $lendd->member_id      =  $detail->member_id;
        //     $lendd->resource_id    =  $detail->resource_id;
        //     $lendd->issue_date     =  $request->date_settle;
        //     $lendd->return         =  0;
        //     $lendd->fine_amount    =  0;
        //     $lendd->issue_by       =  Auth::user()->id;
        //     $lendd->save();
        // }
        // else                            //settle and return
        // {
        //     $detail->fine_amount    =$request->fine_amount;
        //     $detail->return         =1;
        //     $detail->return_date    =$request->date_settle;
        //     $detail->return_by      =Auth::user()->id;
        //     $detail->save();
        // }

        return response()->json(['massage' => "success"]);
    }

    public function store_return(Request $request)
    {
        $lang = session()->get('db_locale');
        $lib_name="name".$lang;
        $detail=lending_detail::find($request->cellVal_lend_id);
        if($detail)
        {
            $detail->return=1;
            $detail->return_date=$request->dtereturn;
            $detail->return_by=Auth::user()->id;
            $detail->save();

             //-------------------SMS Alert-----------------------------
            $SoapController =new SoapController;
            $mobile_no=$request->membermobile;
           
            $library = session()->get('library');
            if(!empty($library))
            {
                $library_name=$library->$lib_name;
            }
          
            if($lang=="_si"){
                $message_text= $library_name."-ආපසු භාර දීම්\r\n \r\n"."සාමාජික විස්තර -".$request->membername."(".$request->mem_id.")"."\r\n"."ආපසු භාර දීම් විස්තර - ".$request->description."\r\n"."ආපසු භාරදුන් දිනය - ".$request->dtereturn."\r\n"."ස්තූතියි!";
            }
            elseif($lang=="_en"){
              
            }
            else{
               
            }
            $setting_sms_send = setting::where('setting', 'sms_return')->first();
            if ($setting_sms_send->value == "1") 
            {
                if($SoapController->is_connected()==true)
                { $SoapController->multilang_msg_Send($mobile_no,$message_text);} 
            } 
           
            //-----------------------End SMS Alert----------------------

            return response()->json(['massage' => "success",'lendid' =>$request->cellVal_lend_id]);
        }
        else
        {
            return response()->json(['massage' => "error"]);
        }
       
    }

    public function fine_receipt(Request $request)
    {
        $receipt=new receipt;
        $receipt->receipt_date  =$request->date_settle;
        $receipt->member_id     =$request->mem_id;
        $receipt->receipts      =$request->receipt;
        $receipt->receipt_type  =$request->receipt_type;
        $receipt->referance     =$request->referance;
        $receipt->payment       =$request->receipt_tot_fine;
        $receipt->user_id       =Auth::user()->id;
        $receipt->save();
        Session::put('receipt_id', $receipt->id);

        if($receipt)
        {
            return response()->json(['massage' => "success",'receipt_id' => $receipt->id]);
        }
        else
        {
            return response()->json(['massage' => "error"]);
        }
       
    }
    public function extend_lending(Request $request)
    {
        $detail=lending_detail::find($request->lend_id);
        if($detail)
        {
            $detail->fine_amount    =$request->fine_amount;
            $detail->return         =1;
            $detail->return_date    =$request->dtereturn;
            $detail->return_by      =Auth::user()->id;
            $detail->save();

            $lend=new lending;
            $lend->member_id        =  $detail->member_id;
            $lend->description      =  $request->accno;
            $lend->issue_date       =  $request->dtereturn;
            $lend->save();

            $lendd=new lending_detail;
            $lendd->lending_id     =  $lend->id;
            $lendd->member_id      =  $detail->member_id;
            $lendd->resource_id    =  $detail->resource_id;
            $lendd->issue_date     =  $request->dtereturn;
            $lendd->return         =  0;
            $lendd->fine_amount    =  0;
            $lendd->issue_by       =  Auth::user()->id;
            $lendd->save();
            return response()->json(['massage' => "success"]);
        }
        else
        {
            return response()->json(['massage' => "error"]);
        }
       
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

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
