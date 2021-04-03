<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\setting;

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
        return view('settings.lms.index');
    }
    public function lending_setting()
    {
        return view('settings.lms.index');
    }
    public function notification_setting()
    {
        return view('settings.lms.index');
    }

    public function update_theme(Request $request)
    {
        $theme_option = theme::where('user_id', Auth::user()->id)->first();
        if ($theme_option){
            $theme_option->theme=$request->theme;
            $theme_option->save();
            Session::put('theme', $theme_option->theme);
        } 
        else {
            $theme=new theme;
            $theme->user_id=Auth::user()->id;
            $theme->theme=$request->theme;
            $theme->save();
            Session::put('theme', $theme->theme);
        }
        // return redirect()->route('home')->with('success','Theme Change successfully.');
        return redirect()->route('home');
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

        // $routeName = $select->route()->getName();
	    // dd($routeName);
        return redirect()->back();
    }
}
