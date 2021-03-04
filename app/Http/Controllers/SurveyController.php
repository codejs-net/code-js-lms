<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\survey;
use App\Models\survey_suggestion;
use App\Models\resource;
use App\Models\setting;
use App\Models\view_resource_data;
use App\Models\lending_detail;
use App\Models\lending;
use App\Models\view_lending_data;
use App\Http\Controllers\SoapController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;
use Carbon\Carbon;
use Auth;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveydate = Carbon::now()->isoFormat('YYYY-MM-DD');
        $survey=survey::all();
        return view('survey.index')->with('Sdata',$survey)->with('surveydate',$surveydate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $resource_count = DB::table('resources')->count();

        $remove_resources = resource::where('status','0')->get();
        $removeReources_count = count($remove_resources);

        $svr=new survey;
        $svr->start_date=$request->survey_date;
        $svr->total_resources=$resource_count;
        $svr->removed_resources=$removeReources_count;
        $svr->lending_resources=0;
        $svr->survey_resources=0;
        $svr->non_survey_resources=0;
        $svr->create_by=Auth::user()->id;
        $svr->save();
        // -------------------------

        $insert_data = [];
        $json = resource::select('id')->where('status', '1')->get();
        // $json= DB::table('resources')->select('id')->where('status', '1')->get();

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
        return redirect()->back();
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

        
        // if(request()->ajax())
        // {
            // $surveydata=survey_temp::all();
            // $surveydata = DB::table('survey_temps')
        //     $surveydata = survey_temp::where('status',1)
        //         ->join('survey_suggetions', 'survey_temps.suggestion_id', '=', 'survey_suggetions.id')
        //         ->select('survey_temps.*', 'survey_suggetions.Suggetion')
        //         ->get();
        //     return datatables()->of($surveydata)
        //             ->addColumn('survey', function($data){
        //                 if($data->survey==1)
        //                 {$button = '<label class="btn btn-success btn-sm"><i class="fa fa-check" ></i></label>';}
        //                 else
        //                 {$button = '<label class="btn btn-default btn-sm"><i class="fa fa-minus" ></i></label>';}
                        
        //                 return $button;  
        //             })
                    
        //             ->rawColumns(['survey'])
        //             ->make(true);
        // }
        // $bookcount = DB::table('survey_temps')->count();

        // $survey_c = survey_temp::where('survey','1')->get();
        // $survey_count = count($survey_c);

        $survey_sug=survey_suggestion::all();

        // return view('boardOfSurvey.survey')->with('Bcount',$bookcount)->with('Scount',$survey_count)->with('sdata',$survey_sug);
        return view('survey.survey')->with('sdata',$survey_sug);
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
