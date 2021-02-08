<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book;
use App\Models\resource_category;
use App\Models\resource_type;
use App\Models\book_publisher;
use App\Models\book_medium;
use App\Models\book_dd;
use App\Models\setting;
use Session;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

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

        //  $bookdata = DB::table('books')
        //         ->join('book_cats', 'books.book_category_id', '=', 'book_cats.id')
        //         ->join('book_langs', 'books.language_id', '=', 'book_langs.id')
        //         ->join('book_publishers', 'books.publisher_id', '=', 'book_publishers.id')
        //         ->select('books.*', 'book_cats.category'.$lang, 'book_langs.language'.$lang, 'book_publishers.publisher'.$lang)
        //         ->get();

        //         $booktitle="book_title".$lang;

        $resouredata = DB::table('resources')->get();
        $resource_category=resource_category::all();

            if(request()->ajax())
            {
               
                return datatables()->of($resouredata)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                            $button = '<a href="/update_book_view/'.$data->id.'" class="btn btn-success btn-sm"><i class="fa fa-pencil" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a class="btn btn-warning btn-sm " data-toggle="modal" data-target="#book_delete" data-bookid="'.$data->id.'" data-book_title="'.$data->book_title_si.'"><i class="fa fa-trash" ></i></a>';
                            return $button;
                            
                            
                        })
                        ->addColumn('status', function ($data) {
                            if($data->status==0)
                            {
                                $sts = 'Removed';
                                
                            }
                            else
                            {$sts = 'Active';}
                            return  $sts;
                            
                        })
                        ->rawColumns(['action','status'])
                        ->make(true);
            }
        return view('resources.index')->with('Cat_data',$resource_category);
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
}
