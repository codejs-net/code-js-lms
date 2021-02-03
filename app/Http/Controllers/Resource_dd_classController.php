<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resource_dd_class;
use App\Imports\Resource_dd_classImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

class Resource_dd_classController extends Controller
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
        $details = resource_dd_class::orderBy('id','ASC')->paginate(5);
        return view('resource_support.resource_dd_class.index',compact('details'));
       
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

        $form_data = array(
            'class_code'    =>  $request->class_code,
            'class_si'      =>  $request->name_si,
            'class_ta'      =>  $request->name_ta,
            'class_en'      =>  $request->name_en, 
        );
        resource_dd_class::create($form_data);
        return redirect()->route('resource_dd_class.index')->with('success','Details created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        
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

        $detail=resource_dd_class::find($request->id_update);

        $detail->class_code=$request->class_code_update;
        $detail->class_si=$request->name_update_si;
        $detail->class_ta=$request->name_update_ta;
        $detail->class_en=$request->name_update_en;
        $detail->save();
        return redirect()->route('resource_dd_class.index')->with('success','Details Updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $detail=resource_dd_class::find($request->id_delete);
        $detail->delete();
        return redirect()->route('resource_dd_class.index')->with('warning','Details Removed successfully.');
    }
    public function import() 
    {
        // resource_category::query()->truncate();
        $data=Excel::import(new Resource_dd_classImport,request()->file('file'));
        return redirect()->route('resource_dd_class.index')->with('success','Details imported successfully.');
    }
}
