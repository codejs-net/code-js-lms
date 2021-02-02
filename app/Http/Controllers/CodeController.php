<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\CodeExport;
use App\Imports\CodeImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\code;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PDF;
use DataTables;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CodeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:code-import|code-genarate', ['only' => ['index','import','barcoderange','barcodeview','importExportView','export','import']]);
         $this->middleware('permission:code-genarate', ['only' => ['generateCodePDF','CodeRangepdf']]);
    }

    public function index(Request $request)
    {

        code::query()->truncate();
        $codes = code::orderBy('id', 'ASC')->paginate(5);
        return view('Supports.barcode',compact('codes'))->with('codes',$codes);
       
        // dd($data);
        // if ($request->ajax()) {
        //     $data = code::select('*');
        //     return Datatables::of($data)
        //             ->addColumn('action', function($data){
        //                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
        //                     return $btn;
        //             })
        //             ->addColumn('Barcode', function($data){
        //                 $bcode = '<img src="data:image/png;base64,{{DNS1D::getBarcodePNG("12354", "C128",1,60,array(0,0,0), true)}}" alt="barcode" />';
        //                  return $bcode;
        //             })
        //             ->rawColumns(['action','Barcode'])
        //             ->make(true);
        // }
        // return view('Supports.barcode');

       
        
        
    }

    public function barcodeview()
    {
        $codes = code::orderBy('id', 'ASC')->paginate(5);
        return view('Supports.barcode',compact('codes'))->with('codes',$codes);
    }

    public function barcoderange()
    {
        
        return view('Supports.barcodeRange');
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('import');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new CodeExport, 'codes.xlsx');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        // dd($request->file);
        code::query()->truncate();

        Excel::import(new CodeImport,request()->file('file'));
             
        return redirect()->route('barcodeview');
    }

    public function generateCodePDF(Request $request)
    {
        $data= array();
        $data[0]=$request->txt_start;
        $data[1]=$request->txt_end;
        // $codes = DB::table('codes')->pluck('code');
        $codes = DB::table('codes')->get();
        //$codes = codes::orderBy('id', 'DESC')->get();

        PDF::setOptions(['dpi' => 1200, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('supports.CodePDF', compact('codes','data'))->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->download('Barcodes.pdf');
        
        
    }

    public function CodeRangepdf(Request $request)
    {
        $data= array();
        $data[0]=$request->txt_start;
        $data[1]=$request->txt_end;
        $data[2]=$request->txt_prefix;
        // dd($data);
       

        PDF::setOptions(['dpi' => 1200, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('supports.RangeCodePDF', compact('data'))->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->download('BarcodesRange.pdf');

        
    }
}
