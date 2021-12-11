<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resource_category;
use App\Imports\Resource_categoryImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use File;

class Resource_categoryController extends Controller
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
        $details = resource_category::orderBy('id','ASC')->paginate(5);
        return view('resource_support.resource_category.index',compact('details'));
       
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
        $imageName = time().'.'.$request->image->extension();   
        $request->image->move(base_path('images'), $imageName);
        $form_data = array(
            'category_si' =>  $request->name_si,
            'category_ta' =>  $request->name_ta,
            'category_en' =>  $request->name_en, 
            'image'       =>  $imageName,
        );
        resource_category::create($form_data);
        return redirect()->route('resource_catagory.index')->with('success','Details created successfully.');
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
        $detail=resource_category::find($request->id_update);
        $imageName =$detail->image;
        if($request->hasFile('image_update')){
            
            $imageName = time().'.'.$request->image_update->extension();   
            $request->image_update->move(base_path('images'), $imageName);

            $old_image = "images/".$detail->image;
            if(File::exists($old_image)) {
                File::delete($old_image);
            }
        }

        $detail->category_si=$request->name_update_si;
        $detail->category_ta=$request->name_update_ta;
        $detail->category_en=$request->name_update_en;
        // $detail->image=$request->hasFile('image_update') ? $image_name : $detail->image;
        $detail->image=$imageName;
        $detail->save();
        return redirect()->route('resource_catagory.index')->with('success','Details Updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $detail=resource_category::find($request->id_delete);
        $detail->delete();
        return redirect()->route('resource_catagory.index')->with('success','Details Removed successfully.');
    }
    public function import() 
    {
        // resource_category::query()->truncate();
        $data=Excel::import(new Resource_categoryImport,request()->file('file'));
        return redirect()->route('resource_catagory.index')->with('success','Details imported successfully.');
    }


}
