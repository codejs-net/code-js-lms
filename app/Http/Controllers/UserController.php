<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\view_user_data;
use App\Models\setting;
use App\Models\staff;
use App\Models\member;
use App\Models\view_usermember_data;
use App\Models\view_userstaff_data;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
use Illuminate\Support\Arr;
use DataTables;
use Session;
    
class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update','update_users','pw_reset']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user_id=Auth::user()->id;
        $user_type=Auth::user()->user_type;
        $user = User::find($user_id);
        $userrole = $user->roles->pluck('name')->first();
        $userdata="";
        if($user_type=="staff")
        {
            $userdata = view_userstaff_data::where('id', $user_id)->first();
        }
        elseif($user_type=="member")
        {
            $userdata = view_usermember_data::where('id', $user_id)->first();
        }

        return view('users.index',compact('user','userrole','userdata'));
    }

    public function update_my_account(Request $request)
    {
        $id=$request->user_id;
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,

        ]);
    
        $user = User::find($id);
        $user->username=$request->username;
        $user->email=$request->email;
        $user->save();

        return redirect()->route('home')
                        ->with('success','User updated successfully');
    }

    // ------------------------staff user----------------------------------------

    public function staff_users(Request $request)
    {
        $locale = session()->get('locale');
        $setting = setting::where('setting','locale_db')->first();
        if($setting->value=="0"){$lang="_".$locale;}
        else{$lang="_".$setting->value;}
        Session::put('db_locale', $lang);

        $data = User::select('users.*','staff.name_si','staff.name_ta','staff.name_en')
                    ->leftJoin('staff', 'users.detail_id', '=', 'staff.id')
                    ->where('user_type',"staff")
                    ->get();

        return view('users.staff_account.index',compact('data'));
    
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_staff_users()
    {
        // $roles = Role::pluck('name','name')->all();
        $roles=Role::all();
        $staffdata=staff::all();
        return view('users.staff_account.create',compact('roles','staffdata'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_staff_users(Request $request)
    {
        $locale = session()->get('locale');
        $setting = setting::where('setting','locale_db')->first();
        if($setting->value=="0"){$lang="_".$locale;}
        else{$lang="_".$setting->value;}
        Session::put('db_locale', $lang);


        $_password="";
        $this->validate($request, [
            'username' => 'required|unique:users,username,',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required'
        ]);

        if($request->preset=="default")
        {
            $setting = setting::where('setting','default_password')->first();
            $_password=Hash::make($setting->value);
        }
        else if($request->preset=="mannual")
        {
            $this->validate($request, [
                'password' => 'required|same:confirm-password',
            ]);
            $_password=Hash::make($request->password);
        }


        $user = User::create([
            'user_type' => "staff",
            'email' => $request->email,
            'username' => $request->username,
            'password' =>  $_password,
            'detail_id' => $request->staff,
        ]);

        $user->assignRole([$request->roles]);
        $userdata = view_userstaff_data::where('id', $user->detail_id)->first();
        // send sms
        $SoapController =new SoapController;
        $mobile_no=$userdata->mobile;
        $library = session()->get('library');
        
        if ($lang == "_si") {
            $message_text=$library->name_si."- පරිශීලක ගිණුම් විස්තර"."\r\n"."නම : ".$userdata->name_si."\r\n"."පරිශිලක නම: ".$user->username."\r\n"."විද්‍යුත් ලිපිනය : ".$user->email."\r\n"."මුරපදය : ".$request->password."\r\n";
        } elseif ($lang == "_en") {
            $message_text=$library->name_en."- User Account Detail"."\r\n"."Name : ".$userdata->name_en."\r\n"."User Name : ".$user->username."\r\n"."Email : ".$user->email."\r\n"."Password : ".$request->password."\r\n";
        } else {
            $message_text=$library->name_ta."- பயனர் கணக்கு விவரம்"."\r\n"."பெயர் : ".$userdata->name_ta."\r\n"."பயனர் பெயர் : ".$user->username."\r\n"."மின்னஞ்சல் : ".$user->email."\r\n"."கடவுச்சொல் : ".$request->password."\r\n";
        }

        $setting_sms_send = setting::where('setting', 'sms_user_create')->first();
        if ($setting_sms_send->value == "1") 
        {
            if($SoapController->is_connected()==true)
            {$SoapController->multilang_msg_Send($mobile_no, $message_text);} 
        } 
        //end sms
    
        return redirect()->route('staff_users')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_staff_users($id)
    {
        $user = User::find($id);
        return view('users.staff_account.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_staff_users($id)
    {
        $user = User::find($id);
        $userRole = $user->roles->pluck('id')->first();
        $roles=Role::all();
        $staffdata=staff::all();
    
        return view('users.staff_account.edit',compact('user','roles','userRole','staffdata'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_staff_users(Request $request)
    {
        $id=$request->user_id;
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            // 'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $user = User::find($id);
        $user->username=$request->username;
        $user->email=$request->email;
        // $user->password=Hash::make($request->password);
        $user->detail_id=$request->staff;
        $user->save();

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole([$request->roles]);
     
        return redirect()->route('staff_users')
                        ->with('success','User updated successfully');
    }

    // ----------------------------------------member user-----------------------------------------

    public function member_users(Request $request)
    {
        $locale = session()->get('locale');
        $setting = setting::where('setting','locale_db')->first();

        if($setting->value=="0"){$lang="_".$locale;}
        else{$lang="_".$setting->value;}
        Session::put('db_locale', $lang);

        $data = User::select('users.*','members.name_si','members.name_ta','members.name_en')
                    ->leftJoin('members', 'users.detail_id', '=', 'members.id')
                    ->where('user_type',"member")
                    ->get();

        return view('users.member_account.index',compact('data'));
    
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_member_users()
    {
        
        // $roles = Role::pluck('name','name')->all();
        $roles=Role::all();
        $memberdata=member::all();
        return view('users.member_account.create',compact('roles','memberdata'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_member_users(Request $request)
    {
        $locale = session()->get('locale');
        $setting = setting::where('setting','locale_db')->first();
        if($setting->value=="0"){$lang="_".$locale;}
        else{$lang="_".$setting->value;}
        Session::put('db_locale', $lang);


        $_password="";
        $this->validate($request, [
            'username' => 'required|unique:users,username,',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required'
        ]);

        if($request->preset=="default")
        {
            $setting = setting::where('setting','default_password')->first();
            $_password=Hash::make($setting->value);
        }
        else if($request->preset=="mannual")
        {
            $this->validate($request, [
                'password' => 'required|same:confirm-password',
            ]);
            $_password=Hash::make($request->password);
        }


        $user = User::create([
            'user_type' => "member",
            'email' => $request->email,
            'username' => $request->username,
            'password' =>  $_password,
            'detail_id' => $request->member,
        ]);

        $user->assignRole([$request->roles]);
    
        return redirect()->route('member_users')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_member_users($id)
    {
        $user = User::find($id);
        return view('users.staff_account.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_member_users($id)
    {
        $user = User::find($id);
        $userRole = $user->roles->pluck('id')->first();
        $roles=Role::all();
        $memberdata=member::all();
    
        return view('users.member_account.edit',compact('user','roles','userRole','memberdata'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_member_users(Request $request)
    {
        $id=$request->user_id;
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            // 'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $user = User::find($id);
        $user->username=$request->username;
        $user->email=$request->email;
        // $user->password=Hash::make($request->password);
        $user->detail_id=$request->member;
        $user->save();

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole([$request->roles]);
     
        return redirect()->route('member_users')
                        ->with('success','User updated successfully');
    }


    public function pw_reset(Request $request)
    {
        $id=$request->user_id;
        $user = User::find($id);

        if($request->preset=="default")
        {
            $setting = setting::where('setting','default_password')->first();
            $user->password=Hash::make($setting->value);

        }
        else if($request->preset=="mannual")
        {
            $this->validate($request, [
                'password' => 'same:confirm-password',
            ]);
            $user->password=Hash::make($request->password);
        }
        $user->save();

        return redirect()->back()->with('success','Password Reset successfully');
    }

    public function delete(Request $request)
    {
        User::find($request->id_delete)->delete();
        return redirect()->back()->with('success','User deleted successfully');
    }
}