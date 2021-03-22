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
use App\Models\view_resource_data_all;
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
        // error_log($request->centerdata);
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
                            $button .= '<a href="edit_resource/'.$data->id.'" class="btn btn-sm btn-outline-info "><i class="fa fa-pencil" ></i></a>';
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

        $resouredata = view_resource_data_all::find($id);
        $categorydata=resource_category::all();
        $languagedata=resource_language::all();
        $publisherdata=resource_publisher::all();
        $creatordata=resource_creator::all();
        $dd_classdata=resource_dd_class::all();
        $dd_devisiondata=resource_dd_division::all();
        $dd_sectiondata=resource_dd_section::all();
        $typedata=resource_type::all();
        $centerdata=center::all();

        return view('resources.edit')
        ->with('resouredata',$resouredata)
        ->with('cat_data',$categorydata)
        ->with('lang_data',$languagedata)
        ->with('pub_data',$publisherdata)
        ->with('type_data',$typedata)
        ->with('dd_class_data',$dd_classdata)
        ->with('dd_devision_data',$dd_devisiondata)
        ->with('dd_section_data',$dd_sectiondata)
        ->with('creator_data',$creatordata)
        ->with('center_data',$centerdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_resource(Request $request)
    {
        $locale = session()->get('locale');
        $lang="_".$locale;

        $res= resource::find($request->resource_id);
        $this->validate($request,[
        'resoure_accession'     =>'required|max:100|min:5',
        'resource_title'.$lang  =>'required',
        'resoure_category'      =>'required',
        'resource_price'        =>'required',
        ]);

        $imageName =$res->image;
        if($request->hasFile('image_update')){
            
            $imageName = $request->resoure_accession.'-'.time().'.'.$request->image_update->extension();   
            $request->image_update->move(public_path('images/resources'), $imageName);

            if($res->image!="default_book.jpg")
            {
                $old_image = "images/resources/".$res->image;
                if(File::exists($old_image)) {
                File::delete($old_image);
            }
            }
            
        }

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
        $res->center_id         =  $request->resource_center;
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
        $res->status            =  $request->status;
        $res->image             =  $imageName;
        
        $res->save();
        if($res)
        { return redirect()->route('resource.index')->with("success","Resource Update Successfully");}
        else
        { return redirect()->back('resource.index')->with("error","Resource Update Faild");}
       
    }


    public function delete(Request $request)
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

    public function resource_catelog(Request $request) 
    {
        $resource_center=center::all();
        $categorydata=resource_category::all();
        $languagedata=resource_language::all();
        $publisherdata=resource_publisher::all();
        $creatordata=resource_creator::all();
        $dd_classdata=resource_dd_class::all();
        $dd_devisiondata=resource_dd_division::all();
        $dd_sectiondata=resource_dd_section::all();
        // $typedata=resource_type::all();

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
        $resouredata = view_resource_data_all::select('*')
        ->where('category_id','LIKE',$catg)
        ->where('center_id','LIKE',$cent)
        ->where('type_id','LIKE',$type)
        ->get();
        
        return datatables()->of($resouredata)
                ->addIndexColumn()
                ->addColumn('details', function($data){
                    $card  ='<div class="card card-body">';
                    $card .= '<label>Title: '.$data->title_si.','.$data->title_ta.','.$data->title_en.'</label><br>';
                    $card .='<label>Creator: '.$data->name_si.','.$data->name_ta.','.$data->name_en.'</label><br>';
                    $card .='<span>Publisher: '.$data->publisher_si.','.$data->publisher_ta.','.$data->publisher_en.'</span><br>';
                    $card .='<span>Language: '.$data->language_si.','.$data->language_ta.','.$data->language_en.'</span><br>';
                    $card .='<span>DDC Class: '.$data->class_si.','.$data->class_si.','.$data->class_si.'</span><br>';
                    $card .='<span>DDC Devision: '.$data->devision_si.','.$data->devision_si.','.$data->devision_si.'</span><br>';
                    $card .='<span>DDC Section: '.$data->section_si.'-'.$data->section_si.','.$data->section_ta.','.$data->section_en.'</span><br>';
                    $card .='<span>DDC: '.$data->ddc.'</span><br>';
                    $card .='<span>Price: '.$data->price.'</span><br>';
                    $card .='<span>Publish Year: '.$data->publishyear.'</span><br>';
                    $card .='<span>Edition: '.$data->edition.'</span><br>';
                    $card .='<label>Physical Detail: '.$data->phydetails.'</label><br>';
                    $card .='<span>Purchase Date: '.$data->purchase_date.'</span><br>';
                    $card .='<span>Rack No: </span><br>';
                    $card .='<span>Floor No: </span><br>';
                    $card .='</div>';
                   
                    return $card;   
                })

                ->addColumn('action', function($data){
                    $button = '<a href="show_resource/'.$data->id.'" class="btn btn-sm btn-outline-success"><i class="fa fa-eye" ></i></a>';
                    return $button;   
                })

                ->addColumn('images', function ($data) {
                    $images  ='<img class="img-resource2" src="images/resources/'. $data->image.'"><br>';
                    $images .='<label>Category: '.$data->category_si.'</label><br>';
                    $images .='<label>Type: '.$data->type_si.'</label><br>';
                    $images .='<label>Accession No: '.$data->accessionNo.'</label><br>';
                    $images .='<label>Standard No: '.$data->standard_number.'</label><br>';
                    return  $images;
                    
                })

                ->rawColumns(['details','action','images'])
                ->make(true);
                        
            }

        return view('resources.catelog')
        ->with('cat_data',$categorydata)
        ->with('center_data',$resource_center)
        ->with('language_data',$languagedata)
        ->with('publisher_data',$publisherdata)
        ->with('creator_data',$creatordata)
        ->with('ddclass_data',$dd_classdata)
        ->with('dddevision_data',$dd_devisiondata)
        ->with('ddsection_data',$dd_sectiondata);


    }

}
