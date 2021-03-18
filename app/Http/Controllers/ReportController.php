<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\resource_category;
use App\Models\resource_type;
use App\Models\resource_creator;
use App\Models\resource_dd_class;
use App\Models\resource_dd_division;
use App\Models\resource_dd_section;
use App\Models\resource_language;
use App\Models\resource_place;
use App\Models\resource_donate;
use App\Models\resource_publisher;
use App\Models\resource;
use App\Models\center;
use App\Models\setting;
use App\Models\view_resource_data;
use Session;


class ReportController extends Controller
{
    function report_recource(Request $request) {

        ini_set('max_execution_time', '600');
        ini_set("pcre.backtrack_limit", "5000000");

        $catg="";$cent="";$type="";

        if($request->catdata=="All"){$catg="%";}
        else{$catg= $request->catdata;}

        if($request->centerdata=="All"){$cent="%";}
        else{$cent= $request->centerdata;}

        if($request->typedata=="All"){$type="%";}
        else{$type= $request->typedata;}

        $resouredata = view_resource_data::select('*')
        ->where('category_id','LIKE',$catg)
        ->where('center_id','LIKE',$cent)
        ->where('type_id','LIKE',$type)
        ->get()
        ->chunk(500);

        // dd($resouredata);
        $pdf = PDF::loadView('reports.rpt_resource',compact('resouredata'),[],
            [
            'format'      => 'A4',
            'orientation' => 'L',
            ]);
        return $pdf->stream('resource.pdf');

    }
}
