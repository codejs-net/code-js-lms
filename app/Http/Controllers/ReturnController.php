<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;
use App\Models\resource;
use App\Models\setting;
use App\Models\view_resource_data;
use App\Models\lending_detail;
use App\Models\lending_return;
use App\Models\lending_issue;
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

        $mbr = member::select('*')
        ->where('regnumber',$request->memberid)
        ->first();
        
        if($mbr)
        {
            $lending_config = lending_config::where('categoryid',$mbr->categoryid)->first();
            Session::put('lending_period', $lending_config->lending_period);
            $lending_period = $lending_config->lending_period;

            $lend = view_lending_data::select('*')
                    ->where('member_id', $mbr->id)
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
                    $lenddata[$i]['regnumber']        =$lend[$i]['regnumber'];
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
                    $lenddata[$i]['fine_settle_id']      =$lend[$i]['fine_settle'];
                    
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


        return response()->json(['massage' => "success"]);
    }

    public function store(Request $request)
    {
        $lang = session()->get('db_locale');
        $lending_period = session()->get('lending_period');
        $lib_name = "name" . $lang;
        $print_r="";
        $print_i="";

        $lend_data=json_decode($request->get('lend_data'));
        $return_data=json_decode($request->get('return_data'));

        $lend_r = new lending_return;
        $lend_r->member_id     =  $lend_data[0]->mem_id;
        $lend_r->description   =  $lend_data[0]->return_descript;
        $lend_r->lending_date  =  $lend_data[0]->dtereturn;
        $lend_r->save();

        foreach($return_data as $item)
        {
            $detail_r=lending_detail::find($item->lend_id);
            if($detail_r)
            {
                $detail_r->lending_return_id=$lend_r->id;
                $detail_r->return=1;
                $detail_r->return_date=$lend_data[0]->dtereturn;
                $detail_r->fine_amount=$item->fine_amount;
                $detail_r->return_by=Auth::user()->id;
                $detail_r->save();

                $print_r.='<tr>';
                $print_r.='<td><span>'.$item->type.'&nbsp;'.$item->title.'('.$item->accno.')'.'</span></td>';
                $print_r.='</tr>';
            }
        }

        if($lend_data[0]->extend_descript !="")
        {
            $lend_i = new lending_issue;
            $lend_i->member_id     =  $lend_data[0]->mem_id;
            $lend_i->description   =  $lend_data[0]->extend_descript;
            $lend_i->lending_date  =  $lend_data[0]->dtereturn;
            $lend_i->save();

            foreach($return_data as $item)
            {
                if($item->return_action=="Extend")
                {
                    $detail_i = new lending_detail;
                    $detail_i->lending_issue_id  =  $lend_i->id;
                    $detail_i->member_id         =  $lend_data[0]->mem_id;
                    $detail_i->resource_id       =  $item->reso_id;
                    $detail_i->issue_date        =  $lend_data[0]->dtereturn;
                    $detail_i->return            =  0;
                    $detail_i->fine_amount       =  0;
                    $detail_i->issue_by          =  Auth::user()->id;
                    $detail_i->save();

                    $print_i.='<tr>';
                    $print_i.='<td><span>'.$item->type.'&nbsp;'.$item->title.'('.$item->accno.')'.'</span></td>';
                    $print_i.='</tr>';
                }
            }
        }

        //-------------------SMS Alert-----------------------------
        $SoapController = new SoapController;
        $mobile_no = $lend_data[0]->membermobile;
        $member_name = $lend_data[0]->membername;
        $returndate = $lend_data[0]->dtereturn;
        $issudate = Carbon::parse($lend_data[0]->dtereturn);
        $extend_returndate = $issudate->addDays($lending_period)->isoFormat('YYYY-MM-DD');

        $library = session()->get('library');
        if (!empty($library)) {
            $library_name = $library->$lib_name;
        }

        
       
        $setting_sms_send = setting::where('setting', 'sms_return')->first();
        if ($setting_sms_send->value == "1") 
        {
            if($SoapController->is_connected()==true)
            {
                $message_text_r = $library_name ."-".trans('Returned')."\r\n \r\n".trans('Member Detail')."-". $member_name ."(". $lend_data[0]->mem_id .")". "\r\n" .trans('Returned Detail')."-". $lend_data[0]->return_descript. "\r\n" .trans('Returned Date')."-" .$returndate. "\r\n".trans('Thank You!');
                $SoapController->multilang_msg_Send($mobile_no, $message_text_r);

                if($lend_data[0]->extend_descript !="")
                {
                    $message_text_i = $library_name ."-".trans('Issue')."\r\n \r\n".trans('Member Detail')."-". $member_name ."(". $lend_data[0]->mem_id .")". "\r\n" .trans('Issue Detail')."-". $lend_data[0]->extend_descript. "\r\n" .trans('To Be Return') ."-". $extend_returndate ."\r\n".trans('Thank You!');
                    $SoapController->multilang_msg_Send($mobile_no, $message_text_i);
                }
            } 
        } 
        
        //-----------------------End SMS Alert----------------------
        return response()->json([
            'status'=>'success',
            'print_r'=>$print_r,
            'print_i'=>$print_i,
            'tobe_return'=>$extend_returndate]);
       
    }

    public function store_return(Request $request)
    {
        
       
        // else
        // {
            return response()->json($return_data);
        // }
       
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
