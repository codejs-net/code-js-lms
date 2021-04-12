<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\library;
use App\Models\center;
use App\Models\staff;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;
use App\Http\Controllers\SoapController;
use Session;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    public function store_library(Request $request)
    {

        $form_data = array(
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
            'description'=>$request->description,
            'image'=>''
        );
        $library=library::create($form_data);

        $form_data_center = array(
            'library_id'=>$library->id,
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
    public $mob;
    
    public function store_staff(Request $request)
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $mbr=new staff;
        // $mbr->center_id=0;
        // $mbr->title=$request->title;
        $mbr->name_si=$request->name_si;
        $mbr->name_ta=$request->name_ta;
        $mbr->name_en=$request->name_en;
        $mbr->address1_si=$request->Address1_si;
        $mbr->address1_ta=$request->Address1_ta;
        $mbr->address1_en=$request->Address1_en;
        $mbr->address2_si=$request->Address2_si;
        $mbr->address2_ta=$request->Address2_ta;
        $mbr->address2_en=$request->Address2_en;
        // $mbr->designetion_id=0;
        $mbr->nic=$request->nic;
        $mbr->mobile=$request->Mobile;
        $mbr->birthday=$request->birthday;
        $mbr->gender=$request->gender;
        $mbr->description=$request->Description_staff;
        $mbr->regdate=$request->registeredDate;
        // $mbr->image="";

        Session::put('mob', $request->Mobile);
        $mbr->save();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return response()->json(['data' => "Success"]);
    }

    public function store_user(Request $request)
    {
        $staff= staff::latest()->first();
        $user = User::create([
            'email' => $request->email,
            'username' => $request->uname,
            'password' =>  Hash::make($request->password),
            'staff_id' => $staff->id
        ]);

        $role = Role::where('name','Admin')->first();
        $user->assignRole([$role->id]);
        // -----------------sms----------------
        $SoapController =new SoapController;
        $mobile_no = session()->get('mob');
        $message_text="Welcome To LMS"."\r\n"."**Admin-User**"."\r\n"."User name :".$request->uname."\r\n"."Password : ".$request->password."\r\n"."Thank you..!";
        $msgStatus=$SoapController->Singal_msg_Send($mobile_no,$message_text);
        // error_log("massage report".$msgStatus);
        //--------------------------------------
        
        return response()->json(['data' => "Success"]);
    }

  
    public function show($id)
    {
        //
    }

   
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
