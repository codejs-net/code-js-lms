<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\designetion;
use App\Imports\Staff_designationImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;

class Staff_designetionController extends Controller
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
        $details = designetion::orderBy('id','ASC')->paginate(5);
        return view('staff_support.designetions.index',compact('details')); 
    }

    public function store(Request $request)
    {
        $form_data = array(
            'designetion_si' =>  $request->name_si,
            'designetion_ta' =>  $request->name_ta,
            'designetion_en' =>  $request->name_en, 
        );
        designetion::create($form_data);
        return redirect()->route('designation.index')->with('success','Details created successfully.');
    }
    
   
    public function update_detail(Request $request)
    {
        $detail=designetion::find($request->id_update);
       
        $detail->designetion_si=$request->name_update_si;
        $detail->designetion_ta=$request->name_update_ta;
        $detail->designetion_en=$request->name_update_en;
        $detail->save();
        return redirect()->route('designation.index')->with('success','Details Updated successfully.');
    }
  
    public function delete(Request $request)
    {
        $detail=designetion::find($request->id_delete);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $detail->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
       
        return redirect()->route('designation.index')->with('success','Details Removed successfully.');
    }


    public function import() 
    {
        // resource_category::query()->truncate();
        $data=Excel::import(new Staff_designationImport,request()->file('file'));
        return redirect()->route('designation.index')->with('success','Details imported successfully.');
    }
}
