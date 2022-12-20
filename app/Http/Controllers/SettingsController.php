<?php

namespace App\Http\Controllers;

use App\Models\User_setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    //

    public function index()
    {
        $title="";
        $settings=User_setting::where('user_id',Auth::user()->id)->first();
        return view('pages.settings.settings',['title'=>$title,'settings'=>$settings]);
    }

    public function save(Request $request)
    {
        $user_id=Auth::user()->id;
        User_setting::where('user_id',$user_id)->delete();
        User_setting::create([
            'user_id' => $user_id,
            'template_color' => $request->template_color,
            'font_size' => $request->font_size
        ]);
        return redirect()->back()->with('success','Settings saved successfully!');

    }
}
