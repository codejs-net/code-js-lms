<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resource_publisher;
use App\Imports\Resource_publisherImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

class Resource_PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $details = resource_publisher::orderBy('id','ASC')->paginate(10);
        return view('resource_support.resource_publisher.index',compact('details'));
       
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

        $this->validate($request,[
            'name'.$lang=>'required|max:255|min:5',
            ]);

        $form_data = array(
            'publisher_si' =>  $request->name_si,
            'publisher_ta' =>  $request->name_ta,
            'publisher_en' =>  $request->name_en, 
        );
        $dta=resource_publisher::create($form_data);

        if(request()->ajax())
        {
            $alldata = resource_publisher::select('id','publisher_si AS name_si','publisher_ta AS name_ta','publisher_en AS name_en')->get();
            return response()->json(['data' =>$alldata ,'dataid'=>$dta->id]);
        }
        else
        {
            return redirect()->route('resource_publisher.index')->with('success','Details created successfully.');
        }
     
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
        // $locale = session()->get('locale');
        // $lang="_".$locale;

        //  request()->validate([
        //     'name_update'.$lang => 'required',
        // ]);
    
        $detail=resource_publisher::find($request->id_update);
        $detail->publisher_si=$request->name_update_si;
        $detail->publisher_ta=$request->name_update_ta;
        $detail->publisher_en=$request->name_update_en;
        $detail->save();
        return redirect()->route('resource_publisher.index')->with('success','Details Updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $detail=resource_publisher::find($request->id_delete);
        $detail->delete();
        return redirect()->route('resource_publisher.index')->with('success','Details Removed successfully.');
    }
    public function import() 
    {
        // resource_publisher::query()->truncate();
        $data=Excel::import(new Resource_publisherImport,request()->file('file'));
        return redirect()->route('resource_publisher.index')->with('success','Details imported successfully.');
    }
}
