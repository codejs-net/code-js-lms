<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member_cat;
use App\Imports\Member_categoryImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;


class Member_categoryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:support_data-list|support_data-create|support_data-edit|support_data-delete', ['only' => ['index','show']]);
         $this->middleware('permission:support_data-create', ['only' => ['create','store']]);
         $this->middleware('permission:support_data-edit', ['only' => ['update_detail']]);
         $this->middleware('permission:support_data-delete', ['only' => ['delete']]);
         $this->middleware('permission:data-import', ['only' => ['import']]);
    }

    public function index()
    {
        $details = member_cat::orderBy('id','ASC')->paginate(5);
        return view('member_support.member_category.index',compact('details'));
       
    }

    public function store(Request $request)
    {
        $form_data = array(
            'category_si' =>  $request->name_si,
            'category_ta' =>  $request->name_ta,
            'category_en' =>  $request->name_en, 
        );
        member_cat::create($form_data);
        return redirect()->route('member_catagory.index')->with('success','Details created successfully.');
    }
    
   
    public function update_detail(Request $request)
    {
        $detail=member_cat::find($request->id_update);
       
        $detail->category_si=$request->name_update_si;
        $detail->category_ta=$request->name_update_ta;
        $detail->category_en=$request->name_update_en;
        $detail->save();
        return redirect()->route('member_catagory.index')->with('success','Details Updated successfully.');
    }
  
    public function delete(Request $request)
    {
        $detail=member_cat::find($request->id_delete);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $detail->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
       
        return redirect()->route('member_catagory.index')->with('success','Details Removed successfully.');
    }
    public function import() 
    {
        // resource_category::query()->truncate();
        $data=Excel::import(new Member_categoryImport,request()->file('file'));
        return redirect()->route('member_catagory.index')->with('success','Details imported successfully.');
    }
}