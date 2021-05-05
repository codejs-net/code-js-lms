<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gender;
use App\Imports\Library_genderImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;

class Library_genderController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:library_support_data-list|library_support_data-create|library_support_data-edit|library_support_data-delete', ['only' => ['index','show']]);
         $this->middleware('permission:library_support_data-create', ['only' => ['create','store']]);
         $this->middleware('permission:library_support_data-edit', ['only' => ['update_detail']]);
         $this->middleware('permission:library_support_data-delete', ['only' => ['delete']]);
         $this->middleware('permission:library_support_data-import', ['only' => ['import']]);
    }

    public function index()
    {
        $details = gender::orderBy('id','ASC')->paginate(5);
        return view('library_support.gender.index',compact('details')); 
    }
    

    public function store(Request $request)
    {
        $form_data = array(
            'gender_si' =>  $request->name_si,
            'gender_ta' =>  $request->name_ta,
            'gender_en' =>  $request->name_en, 
        );
        gender::create($form_data);
        return redirect()->route('genders.index')->with('success','Details created successfully.');
    }
    
   
    public function update_detail(Request $request)
    {
        $detail=gender::find($request->id_update);
       
        $detail->gender_si=$request->name_update_si;
        $detail->gender_ta=$request->name_update_ta;
        $detail->gender_en=$request->name_update_en;
        $detail->save();
        return redirect()->route('genders.index')->with('success','Details Updated successfully.');
    }
  
    public function delete(Request $request)
    {
        $detail=gender::find($request->id_delete);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $detail->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
       
        return redirect()->route('genders.index')->with('success','Details Removed successfully.');
    }


    public function import() 
    {
        // resource_category::query()->truncate();
        $data=Excel::import(new Library_genderImport,request()->file('file'));
        return redirect()->route('genders.index')->with('success','Details imported successfully.');
    }

}
