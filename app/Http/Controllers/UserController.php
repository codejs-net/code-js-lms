<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\view_user_data;
use App\Models\setting;
use App\Models\staff;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
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
    public function index(Request $request)
    {
        $locale = session()->get('locale');
        $setting = setting::where('setting','locale_db')->first();

        if($setting->value=="0"){$lang="_".$locale;}
        else{$lang="_".$setting->value;}
        Session::put('db_locale', $lang);

        $data = User::select('*')->with(['staff'])->get();
        // $data = User::all()->with(['staff']);
        return view('users.index',compact('data'));
    
    }

    public function index1(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('home.dtest');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = Role::pluck('name','name')->all();
        $roles=Role::all();
        $staffdata=staff::all();
        return view('users.create',compact('roles','staffdata'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            'email' => $request->email,
            'username' => $request->username,
            'password' =>  $_password,
            'staff_id' => $request->staff,
        ]);

        $user->assignRole([$request->roles]);
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $userRole = $user->roles->pluck('id')->first();
        $roles=Role::all();
        $staffdata=staff::all();
    
        return view('users.edit',compact('user','roles','userRole','staffdata'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_users(Request $request)
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
        $user->staff_id=$request->staff;
        $user->save();

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole([$request->roles]);
     
        return redirect()->route('users.index')
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

        return redirect()->route('users.index')->with('success','Password Reset successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}