<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\survey_suggestion;
use App\Imports\survey_suggestionImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class Survey_suggestion_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:survey_support_data-list|survey_support_data-create|survey_support_data-edit|survey_support_data-delete', ['only' => ['index','show']]);
         $this->middleware('permission:survey_support_data-create', ['only' => ['create','store']]);
         $this->middleware('permission:survey_support_data-edit', ['only' => ['update_detail']]);
         $this->middleware('permission:survey_support_data-delete', ['only' => ['delete']]);
         $this->middleware('permission:survey_support_data-import', ['only' => ['import']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = survey_suggestion::orderBy('id','ASC')->paginate(10);
        return view('survey_support.survey_suggestion.index',compact('details'));
       
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
            'suggestion_si' =>  $request->name_si,
            'suggestion_ta' =>  $request->name_ta,
            'suggestion_en' =>  $request->name_en, 
        );
        $dta=survey_suggestion::create($form_data);

        if(request()->ajax())
        {
            $alldata = survey_suggestion::select('id','suggestion_si AS name_si','suggestion_ta AS name_ta','suggestion_en AS name_en')->get();
            return response()->json(['data' =>$alldata ,'dataid'=>$dta->id]);
        }
        else
        {
            return redirect()->route('survey_suggestion.index')->with('success','Details created successfully.');
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
    
        $detail=survey_suggestion::find($request->id_update);
        $detail->suggestion_si=$request->name_update_si;
        $detail->suggestion_ta=$request->name_update_ta;
        $detail->suggestion_en=$request->name_update_en;
        $detail->save();
        return redirect()->route('survey_suggestion.index')->with('success','Details Updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $detail=survey_suggestion::find($request->id_delete);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');   
        $detail->delete();
         DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->route('survey_suggestion.index')->with('success','Details Removed successfully.');
    }
    public function import() 
    {
        // survey_suggestion::query()->truncate();
        $data=Excel::import(new survey_suggestionImport,request()->file('file'));
        return redirect()->route('survey_suggestion.index')->with('success','Details imported successfully.');
    }
}
