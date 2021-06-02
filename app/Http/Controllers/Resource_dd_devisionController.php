<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resource_dd_class;
use App\Models\resource_dd_division;
use App\Models\setting;
use App\Imports\Resource_dd_devisionImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Session;

class Resource_dd_devisionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:resource_support_data-list|resource_support_data-create|resource_support_data-edit|resource_support_data-delete', ['only' => ['index','show']]);
         $this->middleware('permission:resource_support_data-create', ['only' => ['create','store']]);
         $this->middleware('permission:resource_support_data-edit', ['only' => ['update_detail']]);
         $this->middleware('permission:resource_support_data-delete', ['only' => ['delete']]);
         $this->middleware('permission:resource_support_data-import', ['only' => ['import']]);
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

        $details = resource_dd_division::orderBy('id','ASC')->with('ddecimal')->paginate(10);
        // dd($details);
        return view('resource_support.resource_dd_devision.index',compact('details'));
       
    }


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
            'dd_class_id'   =>  $request->ddclass,
            'devision_code' =>  $request->devision_code,
            'devision_si'   =>  $request->name_si,
            'devision_ta'   =>  $request->name_ta,
            'devision_en'   =>  $request->name_en, 
        );
        resource_dd_division::create($form_data);
        return redirect()->route('resource_dd_devision.index')->with('success','Data created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show_detail(Request $request)
    {
        $data = resource_dd_division::where('id',$request->d_id)->with(['ddecimal'])->first();
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
        $data = resource_dd_division::where('id',$request->d_id)->with(['ddecimal'])->first();
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
        $detail=resource_dd_division::find($request->id_update);
        $detail->dd_class_id=$request->ddclass_update;
        $detail->devision_code=$request->devision_code_update;
        $detail->devision_si=$request->name_update_si;
        $detail->devision_ta=$request->name_update_ta;
        $detail->devision_en=$request->name_update_en;
        $detail->save();
        return redirect()->route('resource_dd_devision.index')->with('success','Data Updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $detail=resource_dd_division::find($request->id_delete);
        $detail->delete();
        return redirect()->route('resource_dd_devision.index')->with('warning','Data Removed successfully.');
    }
    public function import() 
    {
        // resource_category::query()->truncate();
        $data=Excel::import(new Resource_dd_devisionImport,request()->file('file'));
        return redirect()->route('resource_dd_devision.index')->with('success','Data imported successfully.');
    }
}
