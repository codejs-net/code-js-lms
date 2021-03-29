<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member_cat;
use App\Models\member;
use App\Models\title;
use App\Http\Controllers\SoapController;
use App\Imports\MemberImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use File;
use App\Models\setting;
use App\Models\view_member_data;
use Session;
use DataTables;


class MemberController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locale = session()->get('locale');
        $setting = setting::where('setting','locale_db')->first();

        if($setting->value=="0")
        {$lang="_".$locale;}
        else
        {$lang="_".$setting->value;}

        Session::put('db_locale', $lang);
        
        $resource_title="title".$lang;

            if(request()->ajax())
            {
                $memberdata = view_member_data::select('*')->get();
                return datatables()->of($memberdata)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                           
                            $button  = '<a class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#member_show" data-mid="'.$data->id.'"><i class="fa fa-eye" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="edit_member/'.$data->id.'" class="btn btn-sm btn-outline-info "><i class="fa fa-pencil" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#member_delete" data-mid="'.$data->id.'" data-mname="'.$data->name_en.'"><i class="fa fa-trash" ></i></a>';
                            return $button;   
                        })

                        ->addColumn('status', function ($data) {
                            if($data->status==0)
                            {$sts = 'Removed';}
                            else if($data->status==2)
                            {$sts = 'Backlist';}
                            else
                            {$sts = 'Active';}
                            return  $sts;  
                        })

                        ->addColumn('images', function ($data) {
                            $images='<img class="img-member elevation-2" src="images/members/'. $data->image.'">';
                            return  $images;
                            
                        })

                        ->rawColumns(['action','status','images'])
                        ->make(true);
                        
            }
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
        $titledata=title::all();

        return view('members.create')->with('Mdata',$Memberdata)->with('tdata',$titledata);
       
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

        $imageName ="default_avatar.png";
        $image = $request->file('image_member');
        if ($image){
            $imageName = $request->nic.'-'.time().'.'.$image->extension(); 
            $image->move(public_path('images/members'), $imageName);
        }


        $mbr->titleid=$request->title;
        $mbr->Categoryid=$request->category;
        $mbr->name_si=$request->name_si;
        $mbr->name_ta=$request->name_ta;
        $mbr->name_en=$request->name_en;
        $mbr->address1_si=$request->Address1_si;
        $mbr->address1_ta=$request->Address1_ta;
        $mbr->address1_en=$request->Address1_en;
        $mbr->address2_si=$request->Address2_si;
        $mbr->address2_ta=$request->Address2_ta;
        $mbr->address2_en=$request->Address2_en;
        $mbr->nic=$request->nic;
        $mbr->mobile=$request->Mobile;
        $mbr->birthday=$request->birthday;
        $mbr->gender=$request->gender;
        $mbr->description=$request->Description;
        $mbr->regdate=$request->registeredDate;
        $mbr->image=$imageName;

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
    public function show(Request $request)
    {
        $data = view_member_data::find($request->m_id);
        return response()->json($data);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editdata = member::find($id);
        $Memberdata=member_cat::all();
        $titledata=title::all();
        return view('members.edit')
        ->with('edata',$editdata)
        ->with('Mdata',$Memberdata)
        ->with('tdata',$titledata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_member(Request $request)
    {
        $locale = session()->get('locale');
        $lang="_".$locale;

        $mbr= member::find($request->member_id);
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

        $imageName =$mbr->image;
        if($request->hasFile('image_member')){
            
            $imageName = $request->nic.'-'.time().'.'.$request->image_member->extension();   
            $request->image_member->move(public_path('images/members'), $imageName);

            if($mbr->image!="default_avatar.png")
            {
                $old_image = "images/members/".$mbr->image;
                if(File::exists($old_image)) {
                File::delete($old_image);
                }
            }
            
        }

        $mbr->titleid=$request->title;
        $mbr->Categoryid=$request->category;
        $mbr->name_si=$request->name_si;
        $mbr->name_ta=$request->name_ta;
        $mbr->name_en=$request->name_en;
        $mbr->address1_si=$request->Address1_si;
        $mbr->address1_ta=$request->Address1_ta;
        $mbr->address1_en=$request->Address1_en;
        $mbr->address2_si=$request->Address2_si;
        $mbr->address2_ta=$request->Address2_ta;
        $mbr->address2_en=$request->Address2_en;
        $mbr->nic=$request->nic;
        $mbr->mobile=$request->Mobile;
        $mbr->birthday=$request->birthday;
        $mbr->gender=$request->gender;
        $mbr->description=$request->Description;
        $mbr->regdate=$request->registeredDate;
        $mbr->image=$imageName;
        $mbr->status=$request->status;

        $mbr->save();
        if($mbr)
        { return redirect()->route('members.index')->with("success","Member Update Successfully");}
        else
        { return redirect()->back('members.index')->with("error","Member Update Faild");}
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $member=member::find($request->delete_member_id);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $member->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->back()->with('success','Member Removed successfully.');
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
