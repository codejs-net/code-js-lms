<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resource_category;
use App\Models\resource_type;
use App\Models\center;
use App\Models\setting;
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
    public function index()
    {
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
        
         $resouredata = DB::table('resources')
                ->leftJoin('resource_categories', 'resources.category_id', '=', 'resource_categories.id')
                ->leftJoin('resource_types', 'resources.type_id', '=', 'resource_types.id')
                ->leftJoin('resource_creators', 'resources.cretor_id', '=', 'resource_creators.id')
                ->leftJoin('resource_publishers', 'resources.publisher_id', '=', 'resource_publishers.id')
                ->select('resources.*', 'resource_categories.category'.$lang, 'resource_types.type'.$lang, 'resource_creators.name'.$lang, 'resource_publishers.publisher'.$lang)
                ->get();

                $resource_title="title".$lang;

        $resource_category=resource_category::all();
        $resource_center=center::all();

            if(request()->ajax())
            {
               
                return datatables()->of($resouredata)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                            $button = '<a href="/update_book_view/'.$data->id.'" class="btn btn-success btn-sm"><i class="fa fa-pencil" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a class="btn btn-warning btn-sm " data-toggle="modal" data-target="#book_delete" data-bookid="'.$data->id.'" data-title="'.$data->title_si.'"><i class="fa fa-trash" ></i></a>';
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
                            $images='<img class="img-icon" src="images/resources/'. $data->image.'">';
                            return  $images;
                            
                        })

                        ->rawColumns(['action','status','images'])
                        ->make(true);
            }
        return view('resources.index')->with('cat_data',$resource_category)->with('center_data',$resource_center);
    }

    public function load_type(Request $request)
    {
       if($request->d_cat=="All")
       {$data=resource_type::all();}
       else
       {$data = resource_type::where('category_id',$request->d_cat)->get();}
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

    public function import(Request $request) 
    {
        // resource_category::query()->truncate();

        if($request->hasFile('file'))
        {
            $data=Excel::import(new ResourceImport,request()->file('file'));
            return redirect()->route('resources.index')->with('success','Details imported successfully.');
        }
        else
        {
            return back()->with('warning','Plese Select the Excel File');
        }
    }

}
