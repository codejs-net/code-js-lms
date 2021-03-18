<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\staff;
use Session;
use App\Models\library;
use App\Models\theme;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $locale = session()->get('locale');
        if(empty($locale))
        {
            Session::put('locale', 'si');
        }
        
        $library = library::all()->count();
        if ($library==0) {
            return view('configuration.create');
          }
          else{
            return redirect()->route('lmslogin.index');
          }
    }

    public function index()
    {

        return view('auth.login');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
  
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
        {
            // $loguser=user::find(Auth::user()->id)->with('staff')->first();
            $loguser = User::where('id', Auth::user()->id)->with(['staff'])->first();
            // dd($loguser);
            Session::put('user', $loguser->staff);
            //-----------theme--------------------------------
           
            $theme_option = theme::where('user_id', Auth::user()->id)->first();
            if (!empty($theme_option)){
                Session::put('theme', $theme_option->theme);
            } 
            else {
                Session::put('theme', 'js-default');
            }
            
            //----------end theme-----------------------------

            return redirect()->route('home');

        }else{
            return redirect()->route('lmslogin.index')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }
}
