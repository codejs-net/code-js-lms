<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use File;
use App\Models\setting;
use App\Models\member_guarantor;
use App\Models\title;
use App\Models\gender;
use App\Imports\Member_guarantorImport;
use Session;
use DataTables;

class Member_guarantorController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:member_support_data-list|member_support_data-create|member_support_data-edit|member_support_data-delete', ['only' => ['index','show']]);
         $this->middleware('permission:member_support_data-create', ['only' => ['create','store']]);
         $this->middleware('permission:member_support_data-edit', ['only' => ['edit_member_guarantor','update_detail']]);
         $this->middleware('permission:member_support_data-delete', ['only' => ['delete']]);
         $this->middleware('permission:member_support_data-import', ['only' => ['import']]);
    }

    public function index()
    {
        $locale = session()->get('locale');
        $setting = setting::where('setting','locale_db')->first();

        if($setting->value=="0")
        {$lang="_".$locale;}
        else
        {$lang="_".$setting->value;}

        Session::put('db_locale', $lang);
        $titledata=title::all();
        $genderdata=gender::all();

            if(request()->ajax())
            {
                $memdata = member_guarantor::select('*')->get();
                return datatables()->of($memdata)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                            $button  = '<a class="btn btn-sm btn-outline-success mx-1" data-toggle="modal" data-target="#gurantor_show" data-gid="'.$data->id.'"><i class="fa fa-eye" ></i></a>';
                            $button  .= '<a class="btn btn-sm btn-outline-info mx-1" data-toggle="modal" data-target="#gurantor_edit" data-gid="'.$data->id.'"><i class="fa fa-pencil" ></i></a>';
                            $button .= '<a class="btn btn-sm btn-outline-danger mx-1" data-toggle="modal" data-target="#gurantor_delete" data-gid="'.$data->id.'" data-gname="'.$data->name_en.'"><i class="fa fa-trash" ></i></a>';
                            return $button;   
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                        
            }
        return view('member_support.member_guarantor.index')->with('tdata',$titledata)->with('gedata',$genderdata);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $staffdata=designetion::all();
        // $titledata=title::all();

        // $centerdata=center::all();

        // return view('staff.create')->with('Mdata',$staffdata)->with('tdata',$titledata)->with('cdata',$centerdata);
       
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

        $mbr=new member_guarantor;
        $this->validate($request,[
            'name'.$lang=>'required|max:255|min:5',
            'Address1'.$lang=>'required|max:100|min:5',
            // 'nic'=>'max:12|min:10',
            // 'Mobile'=>'max:12|min:10',
            'description'=>'max:150',
            ]);

        $mbr->titleid=$request->title;
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
        $mbr->genderid=$request->gender;
        $mbr->description=$request->description;
        $mbr->status="1";
        $mbr->save();

        if(request()->ajax())
        {
            $guarantdata=member_guarantor::all();
            return response()->json(['data' =>$guarantdata ,'dataid'=>$mbr->id]);
        }
        else
        {
           
            return redirect()->back()->with('success','Details created successfully.');
        }
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = member_guarantor::find($request->m_id);
        return response()->json($data);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_member_guarantor(Request $request)
    {
        $data = member_guarantor::find($request->g_id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_detail(Request $request)
    {
        $locale = session()->get('locale');
        $lang="_".$locale;

        $mbr= member_guarantor::find($request->guarnt_id);
       
        $mbr->titleid=$request->title_update;
        $mbr->name_si=$request->name_update_si;
        $mbr->name_ta=$request->name_update_ta;
        $mbr->name_en=$request->name_update_en;
        $mbr->address1_si=$request->Address1_update_si;
        $mbr->address1_ta=$request->Address1_update_ta;
        $mbr->address1_en=$request->Address1_update_en;
        $mbr->address2_si=$request->Address2_update_si;
        $mbr->address2_ta=$request->Address2_update_ta;
        $mbr->address2_en=$request->Address2_update_en;
        $mbr->nic=$request->nic_update;
        $mbr->mobile=$request->Mobile_update;
        $mbr->genderid=$request->gender_update;
        $mbr->description=$request->description_update;

        $mbr->save();

        return redirect()->route('member_guarantor.index')->with("success","Guarantar Update Successfully");
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $member=member_guarantor::find($request->id_delete);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $member->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->back()->with('success','Guarantor data Removed successfully.');
    }

    public function import(Request $request) 
    {
        // member::query()->truncate();

        if($request->hasFile('file'))
        {
            $data=Excel::import(new Member_guarantorImport,request()->file('file'));
            return redirect()->route('member_guarantor.index')->with('success','Details imported successfully.');
        }
        else
        {
            return back()->with('warning','Plese Select the Excel File');
        }
    }
}
