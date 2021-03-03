<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\theme;
use Auth;
use Session;

class ThemeController extends Controller
{
    public function index()
    {
        // $theme=theme::all();
        return view('settings.theme.index');
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
        return redirect()->route('home');
    }
}
