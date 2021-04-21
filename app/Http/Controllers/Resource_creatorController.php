<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\resource_creator;
use App\Models\setting;
use App\Models\title;
use App\Imports\resource_creatorImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Session;

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
        $details = resource_creator::orderBy('id','ASC')->paginate(15);
        return view('resource_support.resource_creator.index',compact('details'))->with('tdata',$titledata);
       
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
            'name_si' =>  $request->name_si,
            'name_ta' =>  $request->name_ta,
            'name_en' =>  $request->name_en, 
        );
        resource_creator::create($form_data);
        return redirect()->route('resource_creator.index')->with('success','Details created successfully.');
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
        $locale = session()->get('locale');
        $lang="_".$locale;

         request()->validate([
            'name_update'.$lang => 'required',
        ]);
    
        $detail=resource_creator::find($request->id_update);
        $detail->name_si=$request->name_update_si;
        $detail->name_ta=$request->name_update_ta;
        $detail->name_en=$request->name_update_en;
        $detail->save();
        return redirect()->route('resource_creator.index')->with('success','Details Updated successfully.');
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
