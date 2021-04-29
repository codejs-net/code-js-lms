<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resource_rack;
use App\Imports\Resource_rackImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use File;


class Resource_rackController extends Controller
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
        $details = resource_rack::orderBy('id','ASC')->paginate(5);
        return view('resource_support.resource_rack.index',compact('details'));
       
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
            'rack_si' =>  $request->name_si,
            'rack_ta' =>  $request->name_ta,
            'rack_en' =>  $request->name_en, 
        );
        resource_rack::create($form_data);
        return redirect()->route('resource_rack.index')->with('success','Details created successfully.');
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
        $detail=resource_rack::find($request->id_update);

        $detail->rack_si=$request->name_update_si;
        $detail->rack_ta=$request->name_update_ta;
        $detail->rack_en=$request->name_update_en;
        $detail->save();
        return redirect()->route('resource_rack.index')->with('success','Details Updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $detail=resource_rack::find($request->id_delete);
        $detail->delete();
        return redirect()->route('resource_catagory.index')->with('success','Details Removed successfully.');
    }
    public function import() 
    {
        // resource_category::query()->truncate();
        $data=Excel::import(new Resource_rackImport,request()->file('file'));
        return redirect()->route('resource_rack.index')->with('success','Details imported successfully.');
    }

}
