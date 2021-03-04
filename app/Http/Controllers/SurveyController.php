<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\survey;
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
        //
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
