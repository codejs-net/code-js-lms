<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;
use App\Models\resource;
use App\Models\setting;
use App\Models\view_resource_data;
use Session;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locale = session()->get('locale');
        $db_setting = setting::where('setting','locale_db')->first();
        if($db_setting->value=="0"){$lang="_".$locale;}
        else{$lang="_".$db_setting->value;}
        Session::put('db_locale', $lang);

        $lending_setting = setting::where('setting','lending_count')->first();
        return view('lending.issue.index')->with('lending_setting',$lending_setting);
    }
    
    public function memberview(Request $request)
    {
        $lang = session()->get('db_locale');

        $name="name".$lang;  $address1="address1".$lang;  $address2="address2".$lang;

        $mbr=member::find($request->memberid);
        // return response()->json($data);
        return response()->json(['member_nme' => $mbr->$name,'member_id'=>$mbr->id,'member_adds1'=>$mbr->$address1,'member_adds2'=>$mbr->$address2]);   
    }

    public function resourceview(Request $request)
    {
        $lang = session()->get('db_locale');

        $title="title".$lang;  $category="category".$lang;  $type="type".$lang; $creator="name".$lang;

        $reso = view_resource_data::select('*')
                ->where('accessionNo', $request->resourceinput)
                ->orWhere('standard_number',$request->resourceinput)
                ->first();
        if($reso)
        {
            return response()->json(['id' => $reso->id,
                                    'title' => $reso->$title,
                                    'accno'=>$reso->accessionNo,
                                    'snumber'=>$reso->standard_number,
                                    'category'=>$reso->$category,
                                    'type'=>$reso->$type,
                                    'creator'=>$reso->$creator,
                                    'massage' => "success"]);   
        }
        else 
        {
            return response()->json(['massage' => "error"]);
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
