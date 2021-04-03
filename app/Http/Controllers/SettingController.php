<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\setting;
use App\Models\theme;
use Auth;
use App\Models\User;
use App\Models\lending_config;
use Session;

class SettingController extends Controller
{
    public function lms_setting()
    {
        $theme = setting::where('setting','default_theme')->first();
        $_locale = setting::where('setting','locale')->first();
        $db_locale = setting::where('setting','locale_db')->first();

        return view('settings.lms.index',compact('theme','_locale','db_locale'));
    }
    public function basic_setting()
    {
        return view('settings.basic.index');
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

        $details = lending_config::orderBy('id','ASC')->with('member_cat')->paginate(10);
        // dd($details[0]->member_cat);
        return view('settings.lending.index',compact('details','delault_period','delault_limit'));
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

        return view('settings.notification.index',compact( 'sms_issue',
                                                            'sms_return',
                                                            'sms_member',
                                                            'sms_user',
                                                            'email_issue',
                                                            'email_return',
                                                            'email_member',
                                                            'email_user'
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

    public function update_lending_config(Request $request)
    {
        $details=lending_config::find($request->id_update);
        $details->lending_limit=$request->limit;
        $details->lending_period=$request->period;
        $details->save();
        return redirect()->route('lending_setting')->with('success','Lending Option Apply successfully.');
    }
}
