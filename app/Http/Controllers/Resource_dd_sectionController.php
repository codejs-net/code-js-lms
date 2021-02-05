<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resource_dd_division;
use App\Models\resource_dd_section;
use App\Models\setting;
use App\Imports\resource_dd_sectionImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Session;

class Resource_dd_sectionController extends Controller
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
        // -------------------------------
        $locale = session()->get('locale');
        $setting = setting::where('setting','locale_db')->first();

        if($setting->value=="0")
        {
            $lang="_".$locale;
        }
        else
        {
            $lang="_".$setting->value;
        }
        Session::put('db_locale', $lang);
        //--------------------------------

        $details = resource_dd_section::orderBy('section_code','ASC')->with('ddclass','dddevision')->paginate(10);
        // dd($details);
        return view('resource_support.resource_dd_section.index',compact('details'));
       
    }

    
    public function dddevision(Request $request)
    {
        // error_log("ok");
        $data = resource_dd_division::where('dd_class_id',$request->d_class)->get();
        return response()->json($data);
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
        
        $form_data = array(
            'dd_devision_id'   =>  $request->dddevision,
            'dd_class_id'      =>  $request->ddclass,
            'section_code'     =>  $request->section_code,
            'section_si'       =>  $request->name_si,
            'section_ta'       =>  $request->name_ta,
            'section_en'       =>  $request->name_en, 
        );
        resource_dd_section::create($form_data);
        return redirect()->route('resource_dd_section.index')->with('success','Data created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show_detail(Request $request)
    {
        $data = resource_dd_section::where('id',$request->d_id)->with(['ddclass'])->first();
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
        $data = resource_dd_section::where('id',$request->d_id)->with(['ddclass','dddevision'])->first();
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
        $detail=resource_dd_section::find($request->id_update);
        $detail->dd_class_id=$request->ddclass_update;
        $detail->dd_devision_id=$request->dddevision_update;
        $detail->section_code=$request->section_code_update;
        $detail->section_si=$request->name_update_si;
        $detail->section_ta=$request->name_update_ta;
        $detail->section_en=$request->name_update_en;
        $detail->save();
        return redirect()->route('resource_dd_section.index')->with('success','Data Updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $detail=resource_dd_section::find($request->id_delete);
        $detail->delete();
        return redirect()->route('resource_dd_section.index')->with('warning','Data Removed successfully.');
    }
    public function import() 
    {
        // resource_category::query()->truncate();
        $data=Excel::import(new resource_dd_sectionImport,request()->file('file'));
        return redirect()->route('resource_dd_section.index')->with('success','Data imported successfully.');
    }
}
