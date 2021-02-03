<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resource_type;
use App\Models\resource_category;
use App\Models\setting;
use App\Imports\Resource_typeImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Session;

class Resource_typeController extends Controller
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

        $details = resource_type::orderBy('id','ASC')->with('category')->paginate(5);
        return view('resource_support.resource_type.index',compact('details'));
       
    }

    public function category()
    {
        // error_log("ok");
        $data=resource_category::all();
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
        
        $locale = session()->get('locale');
        $lang="_".$locale;

        request()->validate([
            'name'.$lang => 'required',
        ]);
    
        $form_data = array(
            'category_id' =>  $request->category,
            'type_si' =>  $request->name_si,
            'type_ta' =>  $request->name_ta,
            'type_en' =>  $request->name_en, 
        );
        resource_type::create($form_data);
        return redirect()->route('resource_type.index')->with('success','Data created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show_detail(Request $request)
    {
        $data = resource_type::where('id',$request->d_id)->with(['category'])->first();
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
        $data = resource_type::where('id',$request->d_id)->with(['category'])->first();
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
        $detail=resource_type::find($request->id_update);
        $detail->category_id=$request->category_update;
        $detail->type_si=$request->name_update_si;
        $detail->type_ta=$request->name_update_ta;
        $detail->type_en=$request->name_update_en;
        $detail->save();
        return redirect()->route('resource_type.index')->with('success','Data Updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $detail=resource_type::find($request->id_delete);
        $detail->delete();
        return redirect()->route('resource_type.index')->with('success','Data Removed successfully.');
    }
    public function import() 
    {
        // resource_category::query()->truncate();
        $data=Excel::import(new Resource_typeImport,request()->file('file'));
        return redirect()->route('resource_type.index')->with('success','Data imported successfully.');
    }
}
