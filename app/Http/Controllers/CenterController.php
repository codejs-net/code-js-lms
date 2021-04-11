<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\library;
use App\Models\center;
use App\Http\Controllers\SoapController;
use App\Imports\MemberImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use File;
use App\Models\setting;
use Session;
use DataTables;

class CenterController extends Controller
{
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
                $centerdata = center::select('*')->get();
                return datatables()->of($centerdata)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                           
                            $button  = '<a class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#staff_show" data-mid="'.$data->id.'"><i class="fa fa-eye" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="edit_center/'.$data->id.'" class="btn btn-sm btn-outline-info "><i class="fa fa-pencil" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#center_delete" data-sid="'.$data->id.'" data-sname="'.$data->name_en.'"><i class="fa fa-trash" ></i></a>';
                            return $button;   
                        })

                        ->rawColumns(['action'])
                        ->make(true);
                        
            }
        return view('centers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $librarydata=library::all();
        return view('centers.create')->with('ldata',$librarydata);
       
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

        $form_data_center = array(
            'library_id'=>$request->library,
            'name_si'=>$request->lib_name_si,
            'name_ta'=>$request->lib_name_ta,
            'name_en'=>$request->lib_name_en,
            'address1_si'=>$request->lib_address1_si,
            'address1_ta'=>$request->lib_address1_ta,
            'address1_en'=>$request->lib_address1_en,
            'address2_si'=>$request->lib_address2_si,
            'address2_ta'=>$request->lib_address2_ta,
            'address2_en'=>$request->lib_address2_en,
            'telephone'=>$request->telephone,
            'fax'=>$request->fax,
            'email'=>$request->lib_email,
            'description'=>$request->description 
        );

        center::create($form_data_center);

        return response()->json(['data' => "Success"]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = view_staff_data::find($request->m_id);
        return response()->json($data);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editdata = center::find($id);
        $librarydata=library::all();

        return view('centers.edit')
        ->with('edata',$editdata)
        ->with('ldata',$librarydata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_center(Request $request)
    {
        $locale = session()->get('locale');
        $lang="_".$locale;

        $mbr= center::find($request->center_id);
       
        $mbr->library_id=$request->library;
        $mbr->name_si=$request->lib_name_si;
        $mbr->name_ta=$request->lib_name_ta;
        $mbr->name_en=$request->lib_name_en;
        $mbr->address1_si=$request->lib_address1_si;
        $mbr->address1_ta=$request->lib_address1_ta;
        $mbr->address1_en=$request->lib_address1_en;
        $mbr->address2_si=$request->lib_address2_si;
        $mbr->address2_ta=$request->lib_address2_ta;
        $mbr->address2_en=$request->lib_address2_en;
        $mbr->telephone=$request->telephone;
        $mbr->fax=$request->fax;
        $mbr->email=$request->lib_email;
        $mbr->description=$request->description;

        $mbr->save();


        if($mbr)
        { return redirect()->route('center.index')->with("success","center Update Successfully");}
        else
        { return redirect()->back('center.index')->with("error","center Update Faild");}
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $center=center::find($request->delete_center_id);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $center->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->back()->with('success','center data Removed successfully.');
    }

    public function import(Request $request) 
    {
        // member::query()->truncate();

        // if($request->hasFile('file'))
        // {
        //     $data=Excel::import(new MemberImport,request()->file('file'));
        //     return redirect()->route('members.index')->with('success','Details imported successfully.');
        // }
        // else
        // {
        //     return back()->with('warning','Plese Select the Excel File');
        // }
    }
}
