<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\title;
use App\Imports\Library_titleImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;


class Library_titleController extends Controller
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
        $details = title::orderBy('id','ASC')->paginate(5);
        return view('library_support.titles.index',compact('details')); 
    }

    public function store(Request $request)
    {
        $form_data = array(
            'title_si' =>  $request->name_si,
            'title_ta' =>  $request->name_ta,
            'title_en' =>  $request->name_en, 
        );
        title::create($form_data);
        return redirect()->route('titles.index')->with('success','Details created successfully.');
    }
    
   
    public function update_detail(Request $request)
    {
        $detail=title::find($request->id_update);
       
        $detail->title_si=$request->name_update_si;
        $detail->title_ta=$request->name_update_ta;
        $detail->title_en=$request->name_update_en;
        $detail->save();
        return redirect()->route('titles.index')->with('success','Details Updated successfully.');
    }
  
    public function delete(Request $request)
    {
        $detail=title::find($request->id_delete);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $detail->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
       
        return redirect()->route('titles.index')->with('success','Details Removed successfully.');
    }


    public function import() 
    {
        // resource_category::query()->truncate();
        $data=Excel::import(new Library_titleImport,request()->file('file'));
        return redirect()->route('titles.index')->with('success','Details imported successfully.');
    }

}
