<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\library;
use App\Models\receipt;
use App\Http\Controllers\SoapController;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use File;
use App\Models\setting;
use Session;
use DataTables;

class ReceiptController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:receipt-list|receipt-create|receipt-edit|receipt-delete', ['only' => ['index','show']]);
         $this->middleware('permission:receipt-create', ['only' => ['create','store']]);
         $this->middleware('permission:receipt-edit', ['only' => ['edit','update_receipt']]);
         $this->middleware('permission:receipt-delete', ['only' => ['delete']]);
    }

    public function index()
    {
        $locale = session()->get('locale');
        $setting = setting::where('setting','locale_db')->first();

        if($setting->value=="0")
        {$lang="_".$locale;}
        else
        {$lang="_".$setting->value;}

        Session::put('db_locale', $lang);

            if(request()->ajax())
            {
                // $receiptdata = receipt::select('*')->get();

                $receiptdata = receipt::select('receipts.*','members.name_si','members.name_ta','members.name_en')
                ->leftJoin('members', 'receipts.member_id', '=', 'members.id')
                ->get();

                return datatables()->of($receiptdata)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                           
                            $button  = '<a class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#staff_show" data-mid="'.$data->id.'"><i class="fa fa-eye" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            // $button .= '<a href="edit_center/'.$data->id.'" class="btn btn-sm btn-outline-info "><i class="fa fa-pencil" ></i></a>';
                            // $button .= '&nbsp;&nbsp;';
                            $button .= '<a class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#center_delete" data-sid="'.$data->id.'" data-sname="'.$data->id.'"><i class="fa fa-trash" ></i></a>';
                            return $button;   
                        })

                        ->rawColumns(['action'])
                        ->make(true);
                        
            }
        return view('receipts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
    }


    public function show(Request $request)
    {
        // $data = view_staff_data::find($request->m_id);
        // return response()->json($data);
    }



    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   


    public function cancel(Request $request)
    {
        // $center=center::find($request->delete_center_id);
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // $center->delete();

        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // return redirect()->back()->with('success','center data Removed successfully.');
    }
}
