<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book;
use App\Models\book_cat;
use App\Models\book_lang;
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

class BookController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:book-list|book-create|book-edit|book-delete', ['only' => ['index','show']]);
         $this->middleware('permission:book-create', ['only' => ['create','store']]);
         $this->middleware('permission:book-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:book-delete', ['only' => ['destroy','delete']]);
    }
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

         $bookdata = DB::table('books')
                ->join('book_cats', 'books.book_category_id', '=', 'book_cats.id')
                ->join('book_langs', 'books.language_id', '=', 'book_langs.id')
                ->join('book_publishers', 'books.publisher_id', '=', 'book_publishers.id')
                ->select('books.*', 'book_cats.category'.$lang, 'book_langs.language'.$lang, 'book_publishers.publisher'.$lang)
                ->get();

                $booktitle="book_title".$lang;

            if(request()->ajax())
            {
               
                return datatables()->of($bookdata)
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
        return view('books.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locale = session()->get('locale');
        $lang="_".$locale;

        $Categorydata=book_cat::all();
        $Languagedata=book_lang::all();
        $Publisherdata=book_publisher::all();
        $Phymediumdata=book_medium::all();
        $Deweydecimaldata=book_dd::all();
        return view('books.create')->with('Cat_data',$Categorydata)->with('Lang_data',$Languagedata)->with('Pub_data',$Publisherdata)
        ->with('PhyMdm_data',$Phymediumdata)->with('DDC_data',$Deweydecimaldata);
    }

    
    public function store(Request $request)
    {
        $locale = session()->get('locale');
        $lang="_".$locale;

        $rules = array(
            'accessionNo'   =>'required|max:100|min:5',
            'isbn'          =>'required|max:100|min:5',
            'book_title'.$lang    =>'required',
            'authors'.$lang       =>'required',
            'price'         =>'required',
            'purchase_date' =>'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return redirect()->back()->withErrors($error)->withInput();
        }
        // dd($request->book_title_si);
        $form_data = array(
            'accessionNo'       =>  $request->accessionNo,
            'isbn'              =>  $request->isbn,
            'book_title_si'     =>  $request->book_title_si,
            'book_title_ta'     =>  $request->book_title_ta,
            'book_title_en'     =>  $request->book_title_en,
            'authors_si'        =>  $request->authors_si,
            'authors_ta'        =>  $request->authors_ta,
            'authors_en'        =>  $request->authors_en,
            'book_category_id'  =>  $request->book_category,
            'language_id'       =>  $request->language,
            'publisher_id'      =>  $request->publisher,
            'phymedium_id'      =>  $request->phymedium,
            'dewey_decimal_id'  =>  $request->dewey_decimal,
            'purchase_date'     =>  $request->purchase_date,
            'edition'           =>  $request->edition,
            'price'             =>  $request->price,
            'publishyear'       =>  $request->publishyear,
            'phydetails'        =>  $request->phydetails,
            'rackno'            =>  $request->rackno,
            'rowno'             =>  $request->rowno,
            'note'              =>  $request->note,
          
            
        );

        book::create($form_data);
        return redirect()->back()->with('success','Book Added successfully!');
    
    }

    
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
        $book=book::find($id);
        $Categorydata=book_cat::all();
        $Languagedata=book_lang::all();
        $Publisherdata=book_publisher::all();
        $Phymediumdata=book_medium::all();
        $Deweydecimaldata=book_dd::all();

        // dd($book);
        return view('books.edit') ->with('selectdata',$book)->with('Cat_data',$Categorydata)->with('Lang_data',$Languagedata)->with('Pub_data',$Publisherdata)
        ->with('PhyMdm_data',$Phymediumdata)->with('DDC_data',$Deweydecimaldata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $locale = session()->get('locale');
        $lang="_".$locale;

        $rules = array(
            'accessionNo'   =>'required|max:100|min:5',
            'isbn'          =>'required|max:100|min:5',
            'book_title'.$lang    =>'required',
            'authors'.$lang       =>'required',
            'price'         =>'required',
            'purchase_date' =>'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return redirect()->back()->withErrors($error)->withInput();
        }

        $book=book::find($id);

        $book->accessionNo=$request->accessionNo;
        $book->isbn=$request->isbn;
        $book->book_title_si=$request->book_title_si;
        $book->book_title_ta=$request->book_title_ta;
        $book->book_title_en=$request->book_title_en;
        $book->authors_si=$request->authors_si;
        $book->authors_ta=$request->authors_ta;
        $book->authors_en=$request->authors_en;

        $book->book_category_id=$request->book_category;
        $book->language_id=$request->language;
        $book->publisher_id=$request->publisher;
        $book->phymedium_id=$request->phymedium;
        $book->dewey_decimal_id=$request->dewey_decimal;
        $book->purchase_date=$request->purchase_date;
        $book->edition=$request->edition;
        $book->price=$request->price;
        $book->publishyear=$request->publishyear;
        $book->phydetails=$request->phydetails;
        $book->rackno=$request->rackno;
        $book->rowno=$request->rowno;
        $book->note=$request->note;
        $book->br_qr_code=$request->br_qr_code;
        $book->status=$request->status;
        
        
        $book->save();
        return redirect()->route('books.index')->with('success','Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $book=new book;
        $book=book::find($request->book_id);
        $book->delete();
    
        return redirect()->route('books.index')->with('success','Book deleted successfully');
    }
}
