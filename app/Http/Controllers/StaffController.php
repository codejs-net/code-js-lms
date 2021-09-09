<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\designetion;
use App\Models\staff;
use App\Models\title;
use App\Models\gender;
use App\Models\center;
use App\Http\Controllers\SoapController;
use App\Imports\StaffImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use File;
use App\Models\setting;
use App\Models\view_staff_data;
use App\Models\center_allocation;
use Session;
use DataTables;

class StaffController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:staff-list|staff-create|staff-edit|staff-delete', ['only' => ['index','show']]);
         $this->middleware('permission:staff-create', ['only' => ['create','store']]);
         $this->middleware('permission:staff-edit', ['only' => ['edit','update_staff']]);
         $this->middleware('permission:staff-delete', ['only' => ['delete']]);
         $this->middleware('permission:staff-import', ['only' => ['import']]);
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
                $staffdata = view_staff_data::select('*')->get();
                return datatables()->of($staffdata)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                           
                            $button  = '<a class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#staff_show" data-mid="'.$data->id.'"><i class="fa fa-eye" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="edit_staff/'.$data->id.'" class="btn btn-sm btn-outline-info "><i class="fa fa-pencil" ></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#staff_delete" data-sid="'.$data->id.'" data-sname="'.$data->name_en.'"><i class="fa fa-trash" ></i></a>';
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
                            $images='<img class="img-member elevation-2" src="images/staffs/'. $data->image.'">';
                            return  $images;
                            
                        })

                        ->rawColumns(['action','status','images'])
                        ->make(true);
                        
            }
        return view('staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffdata=designetion::all();
        $titledata=title::all();
        $genderdata=gender::all();
        $centerdata=center::all();

        return view('staff.create')->with('Mdata',$staffdata)->with('tdata',$titledata)->with('cdata',$centerdata)->with('gedata',$genderdata);
       
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

        $mbr=new staff;
        $this->validate($request,[
            'title'=>'required',
            'designation'=>'required',
            'name'.$lang=>'required|max:100|min:5',
            'Address1'.$lang=>'required|max:100|min:5',
            'nic'=>'required|max:12|min:10',
            'Mobile'=>'required|max:12|min:10',
            'Description'=>'max:150',
            'registeredDate'=>'required',
            ]);

        $imageName ="default_avatar.png";
        $image = $request->file('image_member');
        if ($image){
            $imageName = $request->nic.'-'.time().'.'.$image->extension(); 
            $image->move(base_path('images/staffs'), $imageName);
        }


        $mbr->titleid=$request->title;
        $mbr->designetion_id=$request->designation;
        $mbr->name_si=$request->name_si;
        $mbr->name_ta=$request->name_ta;
        $mbr->name_en=$request->name_en;
        $mbr->address1_si=$request->Address1_si;
        $mbr->address1_ta=$request->Address1_ta;
        $mbr->address1_en=$request->Address1_en;
        $mbr->address2_si=$request->Address2_si;
        $mbr->address2_ta=$request->Address2_ta;
        $mbr->address2_en=$request->Address2_en;
        $mbr->nic=$request->nic;
        $mbr->mobile=$request->Mobile;
        $mbr->birthday=$request->birthday;
        $mbr->genderid=$request->gender;
        $mbr->description=$request->Description;
        $mbr->regdate=$request->registeredDate;
        $mbr->image=$imageName;
        $mbr->status="1";

        $mbr->save();
       
        $check_centr = $request->input('center');
        foreach ($check_centr as $check_centr_id)
        {
            $allocate = new center_allocation;
            $allocate->staff_id=$mbr->id;
            $allocate->center_id=$check_centr_id;
            $allocate->save();
        }

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
        $editdata = staff::find($id);
        $staffdata=designetion::all();
        $titledata=title::all();
        $centerdata=center::all();
        $genderdata=gender::all();

        $center_allocate = DB::table("center_allocations")->where("staff_id",$id)
        ->pluck('center_id','center_id')
        ->all();

        return view('staff.edit')
        ->with('edata',$editdata)
        ->with('Mdata',$staffdata)
        ->with('tdata',$titledata)
        ->with('cdata',$centerdata)
        ->with('gedata',$genderdata)
        ->with('allocatedata',$center_allocate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_staff(Request $request)
    {
        $locale = session()->get('locale');
        $lang="_".$locale;

        $mbr= staff::find($request->staff_id);
        $this->validate($request,[
            'title'=>'required',
            'designation'=>'required',
            'name'.$lang=>'required|max:100|min:5',
            'Address1'.$lang=>'required|max:100|min:5',
            'nic'=>'required|max:12|min:10',
            'Mobile'=>'required|max:12|min:10',
            'gender'=>'required',
            'Description'=>'max:150',
            'registeredDate'=>'required',
            ]);

        $imageName =$mbr->image;
        if($request->hasFile('image_member')){
            
            $imageName = $request->nic.'-'.time().'.'.$request->image_member->extension();   
            $request->image_member->move(base_path('images/staffs'), $imageName);

            if($mbr->image!="default_avatar.png")
            {
                $old_image = "images/staffs/".$mbr->image;
                if(File::exists($old_image)) {
                File::delete($old_image);
                }
            }
            
        }
        $mbr->titleid=$request->title;
        $mbr->designetion_id=$request->designation;
        // $mbr->center_id=$request->center!="all" ? $request->center : null;
        $mbr->name_si=$request->name_si;
        $mbr->name_ta=$request->name_ta;
        $mbr->name_en=$request->name_en;
        $mbr->address1_si=$request->Address1_si;
        $mbr->address1_ta=$request->Address1_ta;
        $mbr->address1_en=$request->Address1_en;
        $mbr->address2_si=$request->Address2_si;
        $mbr->address2_ta=$request->Address2_ta;
        $mbr->address2_en=$request->Address2_en;
        $mbr->nic=$request->nic;
        $mbr->mobile=$request->Mobile;
        $mbr->birthday=$request->birthday;
        $mbr->genderid=$request->gender;
        $mbr->description=$request->Description;
        $mbr->regdate=$request->registeredDate;
        $mbr->image=$imageName;
        $mbr->status=$request->status;

        $mbr->save();

       
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $allocate_old = center_allocation::where('staff_id',$mbr->id)->delete();
        // $allocate_old->center_allocation()->whereIn('id', $$mbr->id)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $check_centr =  $request->input('center');
        if(!empty($check_centr))
        {
            foreach ($check_centr as $check_centr_id)
            {
                $allocate = new center_allocation;
                $allocate->staff_id=$mbr->id;
                $allocate->center_id=$check_centr_id;
                $allocate->save();
            }
        }
        

        if($mbr)
        { return redirect()->route('staff.index')->with("success","Staff Update Successfully");}
        else
        { return redirect()->back('staff.index')->with("error","Staff Update Faild");}
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $member=staff::find($request->delete_staff_id);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $member->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->back()->with('success','Staff data Removed successfully.');
    }

    public function import(Request $request) 
    {
        // member::query()->truncate();

        if($request->hasFile('file'))
        {
            $data=Excel::import(new StaffImport,request()->file('file'));
            return redirect()->route('staff.index')->with('success','Details imported successfully.');
        }
        else
        {
            return back()->with('warning','Plese Select the Excel File');
        }
    }
}
