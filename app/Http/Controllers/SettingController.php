<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\setting;
use App\Models\theme;
use App\Models\library;
use Auth;
use App\Models\User;
use App\Models\lending_config;
use Session;
use File;

class SettingController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:basic_setting-list|basic_setting-edit', ['only' => ['basic_setting']]);
         $this->middleware('permission:basic_setting-edit', ['only' => ['edit','update_basic_setting']]);

         $this->middleware('permission:lms_setting-list|lms_setting-edit', ['only' => ['lms_setting']]);
         $this->middleware('permission:lms_setting-edit', ['only' => ['update_locale','update_db_locale']]);

         $this->middleware('permission:lending_setting-list|lending_setting-edit', ['only' => ['lending_setting']]);
         $this->middleware('permission:lending_setting-edit', ['only' => ['update_lending_config','update_fine','update_period','update_limit']]);

         $this->middleware('permission:notification_setting-list|notification_setting-edit', ['only' => ['notification_setting']]);
         $this->middleware('permission:notification_setting-edit', ['only' => ['update_sms_option','update_email_option']]);
    }
    public function lms_setting()
    {
        $theme = setting::where('setting','default_theme')->first();
        $_locale = setting::where('setting','locale')->first();
        $db_locale = setting::where('setting','locale_db')->first();

        return view('settings.lms.index',compact('theme','_locale','db_locale'));
    }
    public function basic_setting()
    {
        $library = library::first();
        return view('settings.basic.index',compact('library'));
    }

    public function lending_setting()
    {
        $locale = session()->get('locale');
        $setting = setting::where('setting','locale_db')->first();

        if($setting->value=="0")
        {$lang="_".$locale;}
        else
        {$lang="_".$setting->value;}

        Session::put('db_locale', $lang);

        $delault_limit = setting::where('setting','lending_count')->first();
        $delault_period = setting::where('setting','lending_period')->first();
        $fine_rate = setting::where('setting','fine_rate')->first();

        $details = lending_config::orderBy('id','ASC')->with('member_cat')->paginate(10);
        // dd($details[0]->member_cat);
        return view('settings.lending.index',compact('details','delault_period','delault_limit','fine_rate'));
    }

    public function notification_setting()
    {
        $sms_issue = setting::where('setting','sms_issue')->first();
        $sms_return = setting::where('setting','sms_return')->first();
        $sms_member = setting::where('setting','sms_member_create')->first();
        $sms_user = setting::where('setting','sms_user_create')->first();

        $email_issue = setting::where('setting','email_issue')->first();
        $email_return = setting::where('setting','email_return')->first();
        $email_member = setting::where('setting','email_member_create')->first();
        $email_user = setting::where('setting','email_user_create')->first();

        $email_backup = setting::where('setting','email_backup')->first();

        return view('settings.notification.index',compact( 'sms_issue',
                                                            'sms_return',
                                                            'sms_member',
                                                            'sms_user',
                                                            'email_issue',
                                                            'email_return',
                                                            'email_member',
                                                            'email_user',
                                                            'email_backup'
                                                            ));
    }

    public function update_theme(Request $request)
    {
        $settings = setting::where('setting','default_theme')->first();
        $settings->value=$request->theme;
        $settings->save();
        return redirect()->route('lms_setting')->with('success','Default Theme Change successfully.');
    }

    public function update_locale(Request $request)
    {
        return redirect()->route('lms_setting')->with('success','Default Display Language Change successfully.');
    }

    public function update_db_locale(Request $request)
    {
       
        $settings = setting::where('setting','locale_db')->first();
        $settings->value=$request->db_locale;
        $settings->save();
        return redirect()->route('lms_setting')->with('success','DataBase Language Change successfully.');
    }

    public function change_theme($select)
    {
        $theme_option = theme::where('user_id', Auth::user()->id)->first();
        if ($theme_option){
            $theme_option->theme=$select;
            $theme_option->save();
            Session::put('theme', $theme_option->theme);
        } 
        else {
            $theme=new theme;
            $theme->user_id=Auth::user()->id;
            $theme->theme=$select;
            $theme->save();
            Session::put('theme', $theme->theme);
        }

        return redirect()->back();
    }

    public function update_sms_option(Request $request)
    {
        $sms_issue = setting::where('setting','sms_issue')->first();
        $sms_return = setting::where('setting','sms_return')->first();
        $sms_member = setting::where('setting','sms_member_create')->first();
        $sms_user = setting::where('setting','sms_user_create')->first();

        $sms_issue->value=$request->sms_issue == 1 ? 1:0; $sms_issue->save();
        $sms_return->value=$request->sms_return == 1 ? 1:0; $sms_return->save();
        $sms_member->value=$request->sms_member_add == 1 ? 1:0; $sms_member->save();
        $sms_user->value=$request->sms_user_add == 1 ? 1:0; $sms_user->save();

        return redirect()->route('notification_setting')->with('success','SMS Alert Option Apply successfully.');
    }

    public function update_email_option(Request $request)
    {
       
        $email_issue = setting::where('setting','email_issue')->first();
        $email_return = setting::where('setting','email_return')->first();
        $email_member = setting::where('setting','email_member_create')->first();
        $email_user = setting::where('setting','email_user_create')->first();

        $email_issue->value=$request->email_issue == 1 ? 1:0; $email_issue->save();
        $email_return->value=$request->email_return == 1 ? 1:0; $email_return->save();
        $email_member->value=$request->email_member_add == 1 ? 1:0; $email_member->save();
        $email_user->value=$request->email_user_add == 1 ? 1:0; $email_user->save();

        return redirect()->route('notification_setting')->with('success','Email Option Apply successfully.');
    }

    public function update_email_backup(Request $request)
    {
       
        $email_backup = setting::where('setting','email_backup')->first();

        $email_backup->value=$request->email_backup == 1 ? 1:0; $email_backup->save();

        return redirect()->route('notification_setting')->with('success','Email Option Apply successfully.');
    }

    public function update_lending_config(Request $request)
    {
        $details=lending_config::find($request->id_update);
        $details->lending_limit=$request->limit;
        $details->lending_period=$request->period;
        $details->save();
        return redirect()->route('lending_setting')->with('success','Lending Option Apply successfully.');
    }
    public function update_fine(Request $request)
    {
        $fine_rate = setting::where('setting','fine_rate')->first();
        $fine_rate->value=$request->fine_rate;
        $fine_rate->save();
        return redirect()->route('lending_setting')->with('success','Fine rate Apply successfully.');
    }

    public function update_period(Request $request)
    {
        $delault_period = setting::where('setting','lending_period')->first();
        $delault_period->value=$request->default_period;
        $delault_period->save();
        return redirect()->route('lending_setting')->with('success','Default Lending Period Apply successfully.');
    }

    public function update_limit(Request $request)
    {
        $delault_limit = setting::where('setting','lending_count')->first();
        $delault_limit->value=$request->default_limit;
        $delault_limit->save();
        return redirect()->route('lending_setting')->with('success','Default Lending Limit Apply successfully.');
    }

    public function update_library(Request $request)
    {
        $library = library::first();
        $imageName =$library->image;
        if($request->hasFile('image_library')){
            
            $imageName = time().'.'.$request->image_library->extension();   
            $request->image_library->move(public_path('images'), $imageName);

            $old_image = "images".$library->image;
            if(File::exists($old_image)) {
            File::delete($old_image);
            }  
        }
       
        $library->name_si       =$request->lib_name_si;
        $library->name_ta       =$request->lib_name_ta;
        $library->name_en       =$request->lib_name_en;
        $library->address1_si   =$request->lib_address1_si;
        $library->address1_ta   =$request->lib_address1_ta;
        $library->address1_en   =$request->lib_address1_en;
        $library->address2_si   =$request->lib_address2_si;
        $library->address2_ta   =$request->lib_address2_ta;
        $library->address2_en   =$request->lib_address2_en;
        $library->telephone     =$request->telephone;
        $library->fax           =$request->fax;
        $library->email         =$request->lib_email;
        $library->description   =$request->description;
        $library->image         =$imageName;
        $library->save();

        return redirect()->route('home')->with('success','Library Details updated successfully.');
    }
}
