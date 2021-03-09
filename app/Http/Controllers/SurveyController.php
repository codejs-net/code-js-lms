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
use App\Http\Controllers\SoapController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;
use Carbon\Carbon;
use Auth;
use Crypt;

class SurveyController extends Controller
{
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
            return redirect()->back()->with('success','Survey created successfully.');
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

        return view('survey.survey')->with('rcount',$resource_count)->with('scount',$survey_count)->with('sugdata',$survey_sug)->with('sdata',$id);
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
        ->first();
        
        if ($reso) 
        {
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
            else
            {
                return response()->json(['massage' => "lend",'title' => $reso->$title]);
            }
        } 
        else 
        {
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function destroy($id)
    {
        //
    }
}
