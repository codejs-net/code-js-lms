<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\resource_creator;
use App\Models\view_creator_data;
use App\Models\setting;
use App\Models\title;
use App\Models\gender;
use App\Imports\resource_creatorImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Session;
use DataTables;
use File;

class Resource_creatorController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:support_data-list|support_data-create|support_data-edit|support_data-delete', ['only' => ['index','show']]);
         $this->middleware('permission:support_data-create', ['only' => ['create','store']]);
         $this->middleware('permission:support_data-edit', ['only' => ['update_detail']]);
         $this->middleware('permission:support_data-delete', ['only' => ['delete']]);
         $this->middleware('permission:data-import', ['only' => ['import']]);
    }
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
        $titledata=title::all();
        $genderdata=gender::all();

            if(request()->ajax())
            {
                $memdata = view_creator_data::select('*')->get();
                return datatables()->of($memdata)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                            $button  = '<a class="btn btn-sm btn-outline-success mx-1" data-toggle="modal" data-target="#data_show" data-id="'.$data->id.'"><i class="fa fa-eye" ></i></a>';
                            $button  .= '<a class="btn btn-sm btn-outline-info mx-1" data-toggle="modal" data-target="#data_edit" data-id="'.$data->id.'"><i class="fa fa-pencil" ></i></a>';
                            $button .= '<a class="btn btn-sm btn-outline-danger mx-1" data-toggle="modal" data-target="#data_delete" data-id="'.$data->id.'" data-name="'.$data->name_en.'"><i class="fa fa-trash" ></i></a>';
                            return $button;   
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                        
            }
        return view('resource_support.resource_creator.index')->with('tdata',$titledata)->with('gedata',$genderdata);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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

        $mbr=new resource_creator;
        $this->validate($request,[
            'name'.$lang=>'required|max:255|min:5',
            'Address1'.$lang=>'max:100',
            // 'Mobile'=>'max:12|min:10',
            'description'=>'max:255',
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
        $mbr->mobile=$request->Mobile;
        $mbr->genderid=$request->gender;
        $mbr->description=$request->description;
        $mbr->save();

        if(request()->ajax())
        {
            $creatordata=resource_creator::all();
            return response()->json(['data' =>$creatordata ,'dataid'=>$mbr->id]);
        }
        else
        {
           
            return redirect()->back()->with('success','Details created successfully.');
        }
    }
    

    public function show(Request $request)
    {
        $data = view_creator_data::find($request->id);
        return response()->json($data);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit_detail(Request $request)
    {
        $data = view_creator_data::find($request->c_id);
        return response()->json($data);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update_detail(Request $request)
    {
        $locale = session()->get('locale');
        $lang="_".$locale;

        $mbr=resource_creator::find($request->creator_id);
        $this->validate($request,[
            'name_update'.$lang=>'required|max:255|min:5',
            'Address1_update'.$lang=>'max:255',
            // 'Mobile'=>'max:12|min:10',
            'description_update'=>'max:255',
            ]);

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
        $mbr->mobile=$request->Mobile_update;
        $mbr->genderid=$request->gender_update;
        $mbr->description=$request->description_update;
        $mbr->save();

        return redirect()->route('resource_creator.index')->with("success","Creator Update Successfully");
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $detail=resource_creator::find($request->id_delete);
        $detail->delete();
        return redirect()->route('resource_creator.index')->with('success','Details Removed successfully.');
    }
    public function import() 
    {
        // resource_creator::query()->truncate();
        $data=Excel::import(new resource_creatorImport,request()->file('file'));
        return redirect()->route('resource_creator.index')->with('success','Details imported successfully.');
    }
}
