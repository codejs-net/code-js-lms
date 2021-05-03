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
use App\Models\center_allocation;
use App\Models\title;
use App\Models\gender;
use App\Models\resource_rack;
use App\Models\resource_floor;
use App\Models\resource_placement;
use Session;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Imports\ResourceImport;
use File;
use Auth;
use App\Models\User;
use App\Models\staff;

class ResourceController extends Controller
{

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
       
        $loguser = User::where('id', Auth::user()->id)->first();
        $resource_center = center_allocation::where('staff_id', $loguser->detail_id)
        ->with(['staff','center'])
        ->get();

            if(request()->ajax())
            {
                $catg="";
                $type="";
                $cent= $request->centerdata;

                if($request->catdata=="All"){$catg="%";}
                else{$catg= $request->catdata;}

                // if($request->centerdata=="All"){$cent="%";}
                // else{$cent= $request->centerdata;}

                if($request->typedata=="All"){$type="%";}
                else{$type= $request->typedata;}


                // $resouredata =view_resource_data::all();
                $resouredata = view_resource_data::select('*')
                ->where('category_id','LIKE',$catg)
                ->where('center_id',$cent)
                ->where('type_id','LIKE',$type)
                ->get();

        
               

                return datatables()->of($resouredata)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                            $button = '<a href="show_resource/'.$data->id.'" class="btn btn-sm btn-outline-success"><i class="fa fa-eye" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="edit_resource/'.$data->id.'" class="btn btn-sm btn-outline-info "><i class="fa fa-pencil" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#resource_delete" data-resoid="'.$data->id.'" data-resotitle="'.$data->accessionNo.'"><i class="fa fa-trash" ></i></a>';
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

    public function load_category()
    {
        $data=resource_category::all();
        return response()->json($data);
    }

    public function load_type(Request $request)
    {
       if($request->cdta=="All")
       {$data=resource_type::all();}
       else
       {$data = resource_type::where('category_id',$request->cdta)->get();}
        return response()->json($data);
    }

    public function load_rack()
    {
        $data=resource_rack::all();
        return response()->json($data);
    }
    public function load_floor(Request $request)
    {
        $data = resource_floor::where('rack_id',$request->rack)->get();
        return response()->json($data);
    }

    public function load_dd_class()
    {
        $data=resource_dd_class::all();
        return response()->json($data);
    }

    public function load_dd_devision(Request $request)
    {
        $data = resource_dd_division::where('dd_class_id',$request->dd_class_id)->get();
        return response()->json($data);
    }

    public function load_dd_section(Request $request)
    {
        $data = resource_dd_section::where('dd_devision_id',$request->dd_devision_id)->get();
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

    public function create()
    {
        // $locale = session()->get('locale');
        // $lang="_".$locale;

        $categorydata=resource_category::all();
        $languagedata=resource_language::all();
        $publisherdata=resource_publisher::all();
        $creatordata=resource_creator::all();
        $dd_classdata=resource_dd_class::all();
        $titledata=title::all();
        $genderdata=gender::all();
        $rackdata=resource_rack::all();

        $loguser = User::where('id', Auth::user()->id)->first();
        $centerdata = center_allocation::where('staff_id', $loguser->detail_id)
        ->with(['staff','center'])
        ->get();

        return view('resources.create')
            ->with('cat_data',$categorydata)
            ->with('lang_data',$languagedata)
            ->with('pub_data',$publisherdata)
            ->with('dd_class_data',$dd_classdata)
            ->with('creator_data',$creatordata)
            ->with('tdata',$titledata)
            ->with('gedata',$genderdata)
            ->with('rdata',$rackdata)
            ->with('center_data',$centerdata);
    }

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

        $imageName ="default_book.jpg";
        if($request->hasFile('resource_image')){
            $imageName = $request->resoure_accession.'-'.time().'.'.$request->resource_image->extension();   
            $request->resource_image->move(public_path('images/resources'), $imageName);
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
        $res->note_si           =  $request->resource_note_si;
        $res->note_ta           =  $request->resource_note_ta;
        $res->note_en           =  $request->resource_note_en;
        $res->status            =  "1";
        $res->br_qr_code        =  "";
        $res->image             =  $imageName;
        $res->save();

        if (! $request->has('check_place')) {
            $place=new resource_placement;
            $place->resource_id     = $res->id;
            $place->rack_id         = $request->place_rack;
            $place->floor_id        = $request->place_floor;
            $place->placement_index = $request->place_index;
            $place->save();
        }
        return response()->json(['data' => "Success"]);
        
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $resouredata = resource::find($id);
        $categorydata=resource_category::all();
        $languagedata=resource_language::all();
        $publisherdata=resource_publisher::all();
        $creatordata=resource_creator::all();
        $dd_classdata=resource_dd_class::all();
        $rackdata=resource_rack::all();
        $titledata=title::all();
        $genderdata=gender::all();

        $loguser = User::where('id', Auth::user()->id)->first();
        $centerdata = center_allocation::where('staff_id', $loguser->detail_id)
        ->with(['staff','center'])
        ->get();
        $placedata = resource_placement::where('resource_id',$id)
        ->with(['rack','floor'])
        ->first();

        // dd($placedata);
        return view('resources.edit')
        ->with('cat_data',$categorydata)
        ->with('resouredata',$resouredata)
        ->with('lang_data',$languagedata)
        ->with('pub_data',$publisherdata)
        ->with('creator_data',$creatordata)
        ->with('tdata',$titledata)
        ->with('gedata',$genderdata)
        ->with('center_data',$centerdata)
        ->with('dd_class_data',$dd_classdata)
        ->with('rdata',$rackdata)
        ->with('place_data',$placedata);
    }


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
        $res->note_si           =  $request->resource_note_si;
        $res->note_ta           =  $request->resource_note_ta;
        $res->note_en           =  $request->resource_note_en;
        $res->status            =  $request->status;
        $res->image             =  $imageName;
        $res->save();

        if (! $request->has('check_place')) {
            $place = resource_placement::where('resource_id',$request->resource_id)->first();
            if(empty($place))
            {$place=new resource_placement;}

            $place->resource_id     = $request->resource_id;
            $place->rack_id         = $request->place_rack;
            $place->floor_id        = $request->place_floor;
            $place->placement_index = $request->place_index;
            $place->save();  
        }

        if($res)
        { return redirect()->route('resource.index')->with("success","Resource Update Successfully");}
        else
        { return redirect()->back('resource.index')->with("error","Resource Update Faild");}
       
    }


    public function delete(Request $request)
    {
        $resource=resource::find($request->delete_resource_id);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $resource->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->back()->with('success','Resource Removed successfully.');
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
                    $card  ='<div class="elevation-4 category-card">';
                        $card  .='<div class="row p-4">';
                            $card  .='<div class="col-md-3 col-12 category-card-left">';
                                $card .='<img class="img-resource2 p-2" src="images/resources/'. $data->image.'"><br>';
                                $card .='<span><b>Category:</b> '.$data->category_si.'</span><br>';
                                $card .='<span><b>Type:</b> '.$data->type_si.'</span><br>';
                                $card .='<span><b>Accession No:</b> '.$data->accessionNo.'</span><br>';
                                $card .='<span><b>Standard No:</b> '.$data->standard_number.'</span><br>';
                            $card .='</div>';
                            $card .='<div class="col-md-9 col-12">';
                                $card .= '<span><b>Title:</b> '.$data->title_si.','.$data->title_ta.','.$data->title_en.'</span><br>';
                                $card .='<span><b>Creator:</b> '.$data->name_si.','.$data->name_ta.','.$data->name_en.'</span><br>';
                                $card .='<span><b>Publisher:</b> '.$data->publisher_si.','.$data->publisher_ta.','.$data->publisher_en.'</span><br>';
                                $card .='<span><b>Language:</b> '.$data->language_si.','.$data->language_ta.','.$data->language_en.'</span><br>';
                                $card .='<span><b>DDC Class:</b> '.$data->class_si.','.$data->class_si.','.$data->class_si.'</span><br>';
                                $card .='<span><b>DDC Devision:</b> '.$data->devision_si.','.$data->devision_si.','.$data->devision_si.'</span><br>';
                                $card .='<span><b>DDC Section:</b> '.$data->section_si.'-'.$data->section_si.','.$data->section_ta.','.$data->section_en.'</span><br>';
                                $card .='<span><b>DDC: </b>'.$data->ddc.'</span><br>';
                                $card .='<span><b>Price:</b> '.$data->price.'</span><br>';
                                $card .='<span><b>Publish Year:</b> '.$data->publishyear.'</span><br>';
                                $card .='<span><b>Edition:</b> '.$data->edition.'</span><br>';
                                $card .='<span><b>Physical Detail:</b> '.$data->phydetails.'</span><br>';
                                $card .='<span><b>Purchase Date:</b> '.$data->purchase_date.'</span><br>';
                                $card .='<span><b>Rack No:</b> </span><br>';
                                $card .='<span><b>Floor No:</b> </span><br>';
                            $card .='</div>';
                        $card .='</div>';
                    $card .='</div>';
                   
                    return $card;   
                })

                ->addColumn('action', function($data){
                    $button = '<a href="show_resource/'.$data->id.'" class="btn btn-sm btn-outline-success"><i class="fa fa-eye" ></i></a>';
                    return $button;   
                })
                ->rawColumns(['details','action'])
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

    public function catelog_quick_search(Request $request)
    {
        if(request()->ajax())
        {
            $text="%".$request->keyword."%";
            $resouredata = view_resource_data_all::select('*')
            ->where('accessionNo','LIKE',$text)
            ->orwhere('standard_number','LIKE',$text)
            ->orwhere('title_si','LIKE',$text)
            ->orwhere('title_ta','LIKE',$text)
            ->orwhere('title_en','LIKE',$text)
            ->orwhere('category_si','LIKE',$text)
            ->orwhere('category_ta','LIKE',$text)
            ->orwhere('category_en','LIKE',$text)
            ->orwhere('type_si','LIKE',$text)
            ->orwhere('type_ta','LIKE',$text)
            ->orwhere('type_en','LIKE',$text)
            ->orwhere('name_si','LIKE',$text)
            ->orwhere('name_ta','LIKE',$text)
            ->orwhere('name_en','LIKE',$text)
            ->orwhere('publisher_si','LIKE',$text)
            ->orwhere('publisher_ta','LIKE',$text)
            ->orwhere('publisher_en','LIKE',$text)
            ->orwhere('language_si','LIKE',$text)
            ->orwhere('language_ta','LIKE',$text)
            ->orwhere('language_en','LIKE',$text)
            ->orwhere('center_si','LIKE',$text)
            ->orwhere('center_en','LIKE',$text)
            ->orwhere('ddc','LIKE',$text)
            ->orwhere('price','LIKE',$text)
            ->orwhere('purchase_date','LIKE',$text)
            ->orwhere('edition','LIKE',$text)
            ->orwhere('publishyear','LIKE',$text)
            ->orwhere('phydetails','LIKE',$text)
            ->orwhere('note_si','LIKE',$text)
            ->orwhere('note_ta','LIKE',$text)
            ->orwhere('note_en','LIKE',$text)
            ->get();
        
        return datatables()->of($resouredata)
                ->addIndexColumn()
                ->addColumn('details', function($data){
                    $card  ='<div class="elevation-4 category-card">';
                        $card  .='<div class="row p-4">';
                            $card  .='<div class="col-md-3 col-12 category-card-left">';
                                $card .='<img class="img-resource2 p-2" src="images/resources/'. $data->image.'"><br>';
                                $card .='<span><b>Category:</b> '.$data->category_si.'</span><br>';
                                $card .='<span><b>Type:</b> '.$data->type_si.'</span><br>';
                                $card .='<span><b>Accession No:</b> '.$data->accessionNo.'</span><br>';
                                $card .='<span><b>Standard No:</b> '.$data->standard_number.'</span><br>';
                            $card .='</div>';
                            $card .='<div class="col-md-9 col-12">';
                                $card .= '<span><b>Title:</b> '.$data->title_si.','.$data->title_ta.','.$data->title_en.'</span><br>';
                                $card .='<span><b>Creator:</b> '.$data->name_si.','.$data->name_ta.','.$data->name_en.'</span><br>';
                                $card .='<span><b>Publisher:</b> '.$data->publisher_si.','.$data->publisher_ta.','.$data->publisher_en.'</span><br>';
                                $card .='<span><b>Language:</b> '.$data->language_si.','.$data->language_ta.','.$data->language_en.'</span><br>';
                                $card .='<span><b>DDC Class:</b> '.$data->class_si.','.$data->class_si.','.$data->class_si.'</span><br>';
                                $card .='<span><b>DDC Devision:</b> '.$data->devision_si.','.$data->devision_si.','.$data->devision_si.'</span><br>';
                                $card .='<span><b>DDC Section:</b> '.$data->section_si.'-'.$data->section_si.','.$data->section_ta.','.$data->section_en.'</span><br>';
                                $card .='<span><b>DDC: </b>'.$data->ddc.'</span><br>';
                                $card .='<span><b>Price:</b> '.$data->price.'</span><br>';
                                $card .='<span><b>Publish Year:</b> '.$data->publishyear.'</span><br>';
                                $card .='<span><b>Edition:</b> '.$data->edition.'</span><br>';
                                $card .='<span><b>Physical Detail:</b> '.$data->phydetails.'</span><br>';
                                $card .='<span><b>Purchase Date:</b> '.$data->purchase_date.'</span><br>';
                                $card .='<span><b>Rack No:</b> </span><br>';
                                $card .='<span><b>Floor No:</b> </span><br>';
                            $card .='</div>';
                        $card .='</div>';
                    $card .='</div>';
                   
                    return $card;   
                })

                ->addColumn('action', function($data){
                    $button = '<a href="show_resource/'.$data->id.'" class="btn btn-sm btn-outline-success"><i class="fa fa-eye" ></i></a>';
                    return $button;   
                })
                ->rawColumns(['details','action'])
                ->make(true);
                        
            }

        return view('resources.catelog');

    }


}
