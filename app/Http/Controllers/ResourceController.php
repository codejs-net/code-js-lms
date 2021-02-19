<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Imports\ResourceImport;
use File;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->dta);
        $locale = session()->get('locale');
        $setting = setting::where('setting','locale_db')->first();

        if($setting->value=="0")
        {
            $lang="_".$locale;
        }
        else
        {
            $lang="_".$setting->value;
        }
        Session::put('db_locale', $lang);
        
        $resource_title="title".$lang;

        $resource_category=resource_category::all();
        $resource_center=center::all();

            if(request()->ajax())
            {
                $catg="";$cent="";$type="";

                if($request->catdata=="All"){$catg="%";}
                else{$catg= $request->catdata;}

                if($request->centerdata=="All"){$cent="%";}
                else{$cent= $request->centerdata;}

                if($request->typedata=="All"){$type="%";}
                else{$type= $request->typedata;}


                // $resouredata =view_resource_data::all();
                $resouredata = view_resource_data::select('*')
                ->where('category_id','LIKE',$catg)
                ->where('center_id','LIKE',$cent)
                ->where('type_id','LIKE',$type)
                ->get();

        
               

                return datatables()->of($resouredata)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                            $button = '<a href="show_resource/'.$data->id.'" class="btn btn-sm btn-outline-success"><i class="fa fa-eye" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="update_resource/'.$data->id.'" class="btn btn-sm btn-outline-info "><i class="fa fa-pencil" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#book_delete" data-bookid="'.$data->id.'" data-title="'.$data->title_si.'"><i class="fa fa-trash" ></i></a>';
                            return $button;   
                        })

                        ->addColumn('status', function ($data) {
                            if($data->status==0)
                            {$sts = 'Removed';}
                            else
                            {$sts = 'Active';}
                            return  $sts;  
                        })

                        ->addColumn('images', function ($data) {
                            $images='<img class="img-resource" src="images/resources/'. $data->image.'">';
                            return  $images;
                            
                        })

                        ->rawColumns(['action','status','images'])
                        ->make(true);
            }
        return view('resources.index')->with('cat_data',$resource_category)->with('center_data',$resource_center);
    }

    public function load_type(Request $request)
    {
       if($request->cdta=="All")
       {$data=resource_type::all();}
       else
       {$data = resource_type::where('category_id',$request->cdta)->get();}
        return response()->json($data);
    }

    public function filter_by_type($id)
    {
        //
    }
    public function filter_by_category($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $locale = session()->get('locale');
        // $lang="_".$locale;

        $categorydata=resource_category::all();
        $languagedata=resource_language::all();
        $publisherdata=resource_publisher::all();
        $creatordata=resource_creator::all();
        $dd_classdata=resource_dd_class::all();
        $dd_devisiondata=resource_dd_division::all();
        $dd_sectiondata=resource_dd_section::all();
        $typedata=resource_type::all();
        return view('resources.create')->with('cat_data',$categorydata)->with('lang_data',$languagedata)->with('pub_data',$publisherdata)
        ->with('type_data',$typedata)->with('dd_class_data',$dd_classdata)->with('dd_devision_data',$dd_devisiondata)->with('dd_section_data',$dd_sectiondata)->with('creator_data',$creatordata);
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

        $res=new resource;
        $this->validate($request,[
        'resoure_accession'     =>'required|max:100|min:5',
        'resource_title'.$lang  =>'required',
        'resoure_category'      =>'required',
        'resource_price'        =>'required',
        ]);

        $res->accessionNo       =  $request->resoure_accession;
        $res->standard_number   =  $request->resoure_isn;
        $res->title_si          =  $request->resource_title_si;
        $res->title_ta          =  $request->resource_title_ta;
        $res->title_en          =  $request->resource_title_en;
        $res->cretor_id         =  $request->resource_creator;
        $res->category_id       =  $request->resoure_category;
        $res->type_id           =  $request->resoure_type;
        $res->dd_class_id       =  $request->resource_dd_class;
        $res->dd_devision_id    =  $request->resource_dd_devision;
        $res->dd_section_id     =  $request->resource_dd_section;
        $res->ddc               =  $request->resource_ddc;
        $res->center_id         =  1;
        $res->language_id       =  $request->resource_language;
        $res->publisher_id      =  $request->resource_publisher;
        $res->purchase_date     =  $request->resource_purchase_date;
        $res->edition           =  $request->resource_edition;
        $res->price             =  $request->resource_price;
        $res->publishyear       =  $request->resource_publishyear;
        $res->phydetails        =  $request->resource_phydetails;
        $res->note_si           =  $request->resource_note;
        $res->note_ta           =  $request->resource_note;
        $res->note_en           =  $request->resource_note;
        $res->status            =  "1";
        $res->br_qr_code        =  "";
        $res->image             =  "";

        $res->save();
        return response()->json(['data' => "Success"]);
        
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

    public function import(Request $request) 
    {
        // resource_category::query()->truncate();

        if($request->hasFile('file'))
        {
            $data=Excel::import(new ResourceImport,request()->file('file'));
            return redirect()->route('resource.index')->with('success','Details imported successfully.');
        }
        else
        {
            return back()->with('warning','Plese Select the Excel File');
        }
    }

}
