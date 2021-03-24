<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member_cat;
use App\Models\member;
use App\Http\Controllers\SoapController;
use App\Imports\MemberImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use File;


class MemberController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Memberdata=member_cat::all();

        return view('members.create')->with('Mdata',$Memberdata);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $locale = session()->get('locale');
        $lang="_".$locale;

        $mbr=new member;
        $this->validate($request,[
            'title'=>'required',
            'category'=>'required',
            'name'.$lang=>'required|max:100|min:5',
            'Address1'.$lang=>'required|max:100|min:5',
            'nic'=>'required|max:12|min:10',
            'Mobile'=>'required|max:12|min:10',
            'gender'=>'required',
            'Description'=>'max:150',
            'registeredDate'=>'required',
            ]);

        $mbr->title=$request->title;
        $mbr->Categoryid=$request->category;
        $mbr->name_si=$request->name_si;
        $mbr->name_ta=$request->name_si;
        $mbr->name_en=$request->name_si;
        $mbr->address1_si=$request->Address1_si;
        $mbr->address1_ta=$request->Address1_si;
        $mbr->address1_en=$request->Address1_si;
        $mbr->address2_si=$request->Address2_si;
        $mbr->address2_ta=$request->Address2_si;
        $mbr->address2_en=$request->Address2_si;
        $mbr->nic=$request->nic;
        $mbr->mobile=$request->Mobile;
        $mbr->birthday=$request->birthday;
        $mbr->gender=$request->gender;
        $mbr->description=$request->Description;
        $mbr->regdate=$request->registeredDate;
        $mbr->image="";

        $mbr->save();
       

        $SoapController =new SoapController;
        $mobile_no=$request->Mobile;
        $message_text="Welcome To Bulathkohupitiya Public Library."."\r\n"."Member ID :".$mbr->id."\r\n"."Name : ".$request->name_si."\r\n"."Thank you..!";
        
        $SoapController->Singal_msg_Send($mobile_no,$message_text);
        return response()->json(['data' => "Success"]);
        
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

    public function import(Request $request) 
    {
        // member::query()->truncate();

        if($request->hasFile('file'))
        {
            $data=Excel::import(new MemberImport,request()->file('file'));
            return redirect()->route('members.index')->with('success','Details imported successfully.');
        }
        else
        {
            return back()->with('warning','Plese Select the Excel File');
        }
    }
}
