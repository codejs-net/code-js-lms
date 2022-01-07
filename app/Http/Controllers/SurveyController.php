<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\survey;
use App\Models\survey_suggestion;
use App\Models\survey_detail_temp; 
use App\Models\survey_detail; 
use App\Models\resource;
use App\Models\setting;
use App\Models\lending_detail;
use App\Models\view_survey;
use App\Models\resource_category;
use App\Models\center;
use App\Models\User;
use App\Http\Controllers\SoapController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Services\PayUService\Exception;
use Session;
use Carbon\Carbon;
use Auth;
use Crypt;

class SurveyController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:survey-list|survey-create|survey-edit|survey-delete', ['only' => ['index','view_survey','survey_history']]);
         $this->middleware('permission:survey-create', ['only' => ['create','store']]);
         $this->middleware('permission:survey-edit', ['only' => ['edit']]);
         $this->middleware('permission:survey-delete', ['only' => ['delete']]);
         $this->middleware('permission:survey-finalize', ['only' => ['finalize_survey']]);
         $this->middleware('permission:survey-unfinalize', ['only' => ['unfinalize_survey']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locale = session()->get('locale');
        $db_setting = setting::where('setting', 'locale_db')->first();
        if ($db_setting->value == "0") {
            $lang = "_" . $locale;
        } else {
            $lang = "_" . $db_setting->value;
        }
        Session::put('db_locale', $lang);

        $surveydate = Carbon::now()->isoFormat('YYYY-MM-DD');
        $survey=survey::all();
        $resource_category=resource_category::all();
        $resource_center=center::all();
        return view('survey.index')->with('Sdata',$survey)->with('surveydate',$surveydate)->with('catdata',$resource_category)->with('centdata',$resource_center);
    }

    public function view_survey($id)
    {
        $locale = session()->get('locale');
        $db_setting = setting::where('setting', 'locale_db')->first();
        if ($db_setting->value == "0") {
            $lang = "_" . $locale;
        } else {
            $lang = "_" . $db_setting->value;
        }
        Session::put('db_locale', $lang);

        $surveydate = Carbon::now()->isoFormat('YYYY-MM-DD');
        $survey = survey::where('finalize', $id)->get();
        $resource_category=resource_category::all();
        $resource_center=center::all();
        return view('survey.index')->with('Sdata',$survey)->with('surveydate',$surveydate)->with('catdata',$resource_category)->with('centdata',$resource_center);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $json =DB::table('resources')
        ->select('id')
        ->where('status', '1')
        ->whereIn('category_id', $request->category)
        ->whereIn('center_id', $request->center)
        ->get();

        $resource_count =  count($json);
        if($resource_count>0)
        {
            $catid=implode(',',$request->category);
            $centid=implode(',',$request->center);
            $descrip="Center:".$centid." Category:".$catid;
          
            $svr=new survey;
            $svr->start_date=$request->survey_date;
            $svr->description_si=$descrip;
            $svr->description_ta=$descrip;
            $svr->description_en=$descrip;
            $svr->total_resources=$resource_count;
            $svr->lending_resources=0;
            $svr->survey_resources=0;
            $svr->non_survey_resources=0;
            $svr->create_by=Auth::user()->id;
            $svr->save();
            // -------------------------
    
            $insert_data = [];
            // $json = resource::select('id')->where('status', '1')->get();
           
            foreach ($json as $value) {
                $data = [
                        'resource_id'   => $value->id,
                        'survey_id'     => $svr->id,
                        ];
                $insert_data[] = $data;
            }
    
            $insert_data = collect($insert_data);
            $chunks = $insert_data->chunk(500);
    
            foreach ($chunks as $chunk)
            {
                DB::table('survey_detail_temps')->insert($chunk->toArray());
            }
            return redirect()->route('view_survey',0)->with('success','Survey created successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Empty Resources in Selected Criteria, Survey created Failed');
        }
        
       
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $survey_detail=survey::find($id);

        $locale = session()->get('locale');
        $db_setting = setting::where('setting', 'locale_db')->first();
        if ($db_setting->value == "0") {
            $lang = "_" . $locale;
        } else {
            $lang = "_" . $db_setting->value;
        }
        Session::put('db_locale', $lang);
        if(request()->ajax())
        {
            $surveydata = view_survey::select('*')
                ->where('survey_id', $id)
                ->orderBy('updated_at', 'DESC')
                ->get();
            return datatables()->of($surveydata)
                    ->addColumn('survey', function($data){
                        if($data->survey==1)
                        {$button = '<label class="btn btn-success btn-sm"><i class="fa fa-check" ></i></label>';}
                        else
                        {$button = '<label class="btn btn-default btn-sm"><i class="fa fa-minus" ></i></label>';}
                        
                        return $button;  
                    })
                    
                    ->rawColumns(['survey'])
                    ->make(true);
        }
        $resource_count = view_survey::select('id')
        ->where('survey_id',$id)
        ->count();

        $survey_count = view_survey::select('id')
        ->where('survey_id',$id)
        ->where('survey',1)
        ->count();

        $survey_sug=survey_suggestion::all();
        $nowdate = Carbon::now()->isoFormat('YYYY-MM-DD');

        return view('survey.survey')->with('rcount',$resource_count)->with('scount',$survey_count)->with('sugdata',$survey_sug)->with('sdata',$survey_detail)->with('nowdate',$nowdate);
    }

    public function check_survey(Request $request)
    {
        $lang = session()->get('db_locale');
        $title = "title" . $lang;
        $category = "category" . $lang;
        $type = "type" . $lang;
        $creator = "name" . $lang;
        $massage="";

        $reso = view_survey::select('*')
        ->where('survey_id', $request->surveyid)
        ->where('accessionNo', $request->resourceinput)
        ->orWhere('standard_number', $request->resourceinput)
        ->get();

        if ($reso->count()>0) {
            if ($reso->count()==1) {
                $lend = lending_detail::select('*')
                ->where('resource_id', $reso[0]->resource_id)
                ->Where('return', 0)
                ->first();
                if(!$lend) 
                {
                    if($reso[0]->survey==0)
                    {$massage="success";}
                    else
                    {$massage="check";}
    
                    $data_update=survey_detail_temp::find($reso[0]->id);
                        $data_update->survey=1;
                        $data_update->suggestion_id=$request->suggetion;
                        $data_update->check_by=Auth::user()->id;
                        $data_update->save();
    
                        $survey_count = view_survey::select('id')
                        ->where('survey_id',$request->surveyid)
                        ->where('survey',1)
                        ->count();
                        return response()->json([
                                'title' => $reso[0]->$title,
                                'accno' => $reso[0]->accessionNo,
                                'snumber' => $reso[0]->standard_number,
                                'category' => $reso[0]->$category,
                                'type' => $reso[0]->$type,
                                'creator' => $reso[0]->$creator,
                                'scount'=>$survey_count,
                                'massage' => $massage
                                ]);
                }
                else{
                    return response()->json(['massage' => "lend",'title' => $reso[0]->$title]);
                }
            }
            else{
                // ---------same isbn------------
                return response()->json(['resos'=>$reso,'massage' => "duplicate"]);
            }
        } 
        else {
            return response()->json(['massage' => "error"]);
        }
    }

    public function same_reso_check(Request $request)
    {
        $lang = session()->get('db_locale');
        $title = "title" . $lang;
        $category = "category" . $lang;
        $type = "type" . $lang;
        $creator = "name" . $lang;
        $massage="";

        $reso = view_survey::select('*')
        ->where('survey_id', $request->surveyid)
        ->where('id', $request->select_resoid)
        ->first();

        if ($reso) {
                $lend = lending_detail::select('*')
                ->where('resource_id', $reso->resource_id)
                ->Where('return', 0)
                ->first();
                if(!$lend) 
                {
                    if($reso->survey==0)
                    {$massage="success";}
                    else
                    {$massage="check";}
    
                    $data_update=survey_detail_temp::find($reso->id);
                    $data_update->survey=1;
                    $data_update->suggestion_id=$request->suggetion;
                    $data_update->check_by=Auth::user()->id;
                    $data_update->save();
    
                    $survey_count = view_survey::select('id')
                    ->where('survey_id',$request->surveyid)
                    ->where('survey',1)
                    ->count();
                    return response()->json([
                        'title' => $reso->$title,
                        'accno' => $reso->accessionNo,
                        'snumber' => $reso->standard_number,
                        'category' => $reso->$category,
                        'type' => $reso->$type,
                        'creator' => $reso->$creator,
                        'scount'=>$survey_count,
                        'massage' => $massage
                        ]);
                }
                else{
                    return response()->json(['massage' => "lend",'title' => $reso->$title]);
                }
        } 
        else {
            return response()->json(['massage' => "error"]);
        }
    }

    public function same_reso_uncheck(Request $request)
    {
        $lang = session()->get('db_locale');
        $title = "title" . $lang;
        $category = "category" . $lang;
        $type = "type" . $lang;
        $creator = "name" . $lang;
        $massage="";

        $reso = view_survey::select('*')
        ->where('survey_id', $request->surveyid)
        ->where('id', $request->select_resoid)
        ->first();

        if ($reso) 
        {
            if($reso->survey==1)
            {
               
                $data_update=survey_detail_temp::find($reso->id);
                $data_update->survey=0;
                $data_update->suggestion_id=null;
                $data_update->check_by=null;
                $data_update->save();

                $survey_count = view_survey::select('id')
                ->where('survey_id',$request->surveyid)
                ->where('survey',1)
                ->count();
                return response()->json([
                        'title' => $reso->$title,
                        'accno' => $reso->accessionNo,
                        'snumber' => $reso->standard_number,
                        'category' => $reso->$category,
                        'type' => $reso->$type,
                        'creator' => $reso->$creator,
                        'scount'=>$survey_count,
                        'massage' => "success"
                        ]);

            }
            else
            {
                return response()->json(['massage' => "check",'title' => $reso->$title]);
            }
        } 
        else {
            return response()->json(['massage' => "error"]);
        }
    }

    public function uncheck_survey(Request $request)
    {
        $lang = session()->get('db_locale');
        $title = "title" . $lang;
        $category = "category" . $lang;
        $type = "type" . $lang;
        $creator = "name" . $lang;

        $reso = view_survey::select('*')
        ->where('survey_id', $request->surveyid)
        ->where('accessionNo', $request->resourceinput)
        ->orWhere('standard_number', $request->resourceinput)
        ->first();
        
        if ($reso) 
        {
            if($reso->survey==1)
            {
               
                $data_update=survey_detail_temp::find($reso->id);
                $data_update->survey=0;
                $data_update->suggestion_id=null;
                $data_update->check_by=null;
                $data_update->save();

                $survey_count = view_survey::select('id')
                ->where('survey_id',$request->surveyid)
                ->where('survey',1)
                ->count();
                return response()->json([
                        'title' => $reso->$title,
                        'accno' => $reso->accessionNo,
                        'snumber' => $reso->standard_number,
                        'category' => $reso->$category,
                        'type' => $reso->$type,
                        'creator' => $reso->$creator,
                        'scount'=>$survey_count,
                        'massage' => "success"
                        ]);

            }
            else
            {
                return response()->json(['massage' => "check",'title' => $reso->$title]);
            }
        } 
        else 
        {
            return response()->json(['massage' => "error"]);
        }
    }

    public function finalize_survey(Request $request)
    {
        try {

        $lang = session()->get('db_locale');
        $lend_count=0;

        $json = view_survey::select('*')
        ->where('survey_id', $request->fsurveyid)
        ->get();
        
        $survey_count = view_survey::select('id')
        ->where('survey_id',$request->fsurveyid)
        ->where('survey',1)
        ->count();

        $nonsurvey_count = view_survey::select('id')
        ->where('survey_id',$request->fsurveyid)
        ->where('survey',0)
        ->count();
        
        $insert_data = [];
        foreach ($json as $value) 
        {
            $slend=0;
            $username="";
            if($value->survey==0)
            {
                $lend = lending_detail::select('id')
                ->where('resource_id', $value->resource_id)
                ->Where('return', 0)
                ->first();
                if($lend) 
                {
                    $slend=1;
                    $lend_count++;
                }
            }
            if($value->check_by!="")
            {
                $check_user = User::where('id', $value->check_by)->first();
                $username= $check_user->username;
            }
            
            $data = [
                    'survey_id'   => $value->survey_id,
                    'resource_id' => $value->resource_id,
                    'accessionNo' => $value->accessionNo,
                    'standard_number' => $value->standard_number,
                    'title_si' => $value->title_si,
                    'title_ta' => $value->title_ta,
                    'title_en' => $value->title_en,
                    'cretor_name_si' => $value->name_si,
                    'cretor_name_ta' => $value->name_ta,
                    'cretor_name_en' => $value->name_en,
                    'category_id' => $value->category_id,
                    'category_si' => $value->category_si,
                    'category_ta' => $value->category_ta,
                    'category_en' => $value->category_en,
                    'type_id' => $value->type_id,
                    'type_si' => $value->type_si,
                    'type_ta' => $value->type_ta,
                    'type_en' => $value->type_en,
                    'center_id' => $value->center_id,
                    'center_name_si' => $value->center_si,
                    'center_name_ta' => $value->center_ta,
                    'center_name_en' => $value->center_en,
                    'purchase_date' => $value->purchase_date,
                    'edition' => $value->edition,
                    'price' => $value->price,
                    'phydetails' => $value->phydetails,

                    'lend' => $slend,
                    'survey' => $value->survey,
                    'suggestion_id' => $value->suggestion_id,
                    'suggestion_si' => $value->suggestion_si,
                    'suggestion_ta' => $value->suggestion_ta,
                    'suggestion_en' => $value->suggestion_en,

                    'check_by_id' => $value->check_by,
                    'check_by_name' => $username,
                    ];
            $insert_data[] = $data;
        }

        $insert_data = collect($insert_data);
        $chunks = $insert_data->chunk(500);

        foreach ($chunks as $chunk)
        {
            DB::table('survey_details')->insert($chunk->toArray());
        }

       // --------------------Survey update----------------
            $survey_update= survey::find($request->fsurveyid);
            $survey_update->lending_resources=$lend_count;
            $survey_update->survey_resources=$survey_count;
            $survey_update->non_survey_resources=$nonsurvey_count;
            $survey_update->finalize_date=$request->finalize_date;
            $survey_update->finalize_by=Auth::user()->id;
            $survey_update->finalize=1;
            $survey_update->save();
        // --------------------temp delete------------------
            DB::table('survey_detail_temps')->where('survey_id', $request->fsurveyid)->delete();
        // -------------------------------------------------


        // return redirect()->route('survey.index')->with('success','Survey Finalized successfully.');
        return response()->json(['massage' => "success"]);
        } 
        catch (\Exception $e) {
            // return $e->getMessage();
            // return redirect()->back()->with('error','Survey Finalized Fail.');
            return response()->json(['massage' => "error"]);
        }
    }

    public function survey_history($id)
    {
        $id = Crypt::decrypt($id);
        $survey=survey::find($id);

        $locale = session()->get('locale');
        $db_setting = setting::where('setting', 'locale_db')->first();
        if ($db_setting->value == "0") 
        {$lang = "_" . $locale;}
        else {$lang = "_" . $db_setting->value;}
        Session::put('db_locale', $lang);

        if(request()->ajax())
        {
            $surveyhistory = survey_detail::select('*')
                ->where('survey_id', $id)
                ->orderBy('updated_at', 'DESC')
                ->get();
            return datatables()->of($surveyhistory)
                    ->addColumn('survey_', function($data){
                        if($data->survey==1)
                        {$button = '<label class="text-success"><i class="fa fa-check" ></i></label>';}
                        else
                        {$button = '<label class=""><i class="fa fa-times" ></i></label>';}
                        
                        return $button;  
                    })
                    
                    ->rawColumns(['survey_'])
                    ->make(true);
        }

        return view('survey.history')->with('sdata',$survey);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unfinalize_survey(Request $request)
    {

    }
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $survey=survey::find($request->id_delete);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        if($survey->finalize==0)
        {
            DB::table('survey_detail_temps')->where('survey_id', $survey->id)->delete();
        }
        elseif($survey->finalize==1)
        {
            DB::table('survey_details')->where('survey_id', $survey->id)->delete();
        }
        $survey->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->back()->with('success','Survey Removed successfully.');
    }
}
