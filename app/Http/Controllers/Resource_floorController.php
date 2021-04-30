<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resource_rack;
use App\Models\resource_floor;
use App\Models\setting;
use App\Imports\Resource_floorImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Session;
use File;

class Resource_floorController extends Controller
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

        $details = resource_floor::orderBy('id','ASC')->with('rack')->paginate(10);
        return view('resource_support.resource_floor.index',compact('details'));
       
    }

    public function rack()
    {
        // error_log("ok");
        $data=resource_rack::all();
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
            'rack_id'      =>  $request->rack,
            'floor_si'     =>  $request->name_si,
            'floor_ta'     =>  $request->name_ta,
            'floor_en'     =>  $request->name_en, 
        );
        resource_floor::create($form_data);
        return redirect()->route('resource_floor.index')->with('success','Data created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show_detail(Request $request)
    {
        $data = resource_floor::where('id',$request->d_id)->with(['rack'])->first();
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
        $data = resource_floor::where('id',$request->d_id)->with(['rack'])->first();
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
        $detail=resource_floor::find($request->id_update);
       
        $detail->rack_id=$request->rack_update;
        $detail->floor_si=$request->name_update_si;
        $detail->floor_ta=$request->name_update_ta;
        $detail->floor_en=$request->name_update_en;

        $detail->save();
        return redirect()->route('resource_floor.index')->with('success','Data Updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $detail=resource_floor::find($request->id_delete);
        $detail->delete();
        return redirect()->route('resource_floor.index')->with('success','Data Removed successfully.');
    }
    public function import() 
    {
        // resource_category::query()->truncate();
        $data=Excel::import(new Resource_floorImport,request()->file('file'));
        return redirect()->route('resource_floor.index')->with('success','Data imported successfully.');
    }
}
