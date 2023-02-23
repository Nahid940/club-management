<?php

namespace App\Http\Controllers;

use App\Models\SystemInfo;
use App\Models\User_setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    //

    public function index()
    {
        $title="";
        $settings=User_setting::where('user_id',Auth::user()->id)->first();
        $site_info=SystemInfo::first();
        return view('pages.settings.settings',['title'=>$title,'settings'=>$settings,'site_info'=>$site_info]);
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

        if(!empty($request->logo))
        {
            Storage::disk('local')->delete('public/logo/'. $request->old_logo);
            $input['file'] =$request->file('logo');
            $data['logo']= time().'.'.$input['file']->getClientOriginalExtension();
            $destinationPath = public_path('/storage/logo');
            $imgFile = \Intervention\Image\Facades\Image::make($request->file('logo')->getRealPath());
            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$data['logo']);
        }else
        {
            $data['logo']=$request->old_logo;
        }
        SystemInfo::truncate();

        SystemInfo::create([
            'logo'=>$data['logo'],
            'heading'=>$request->heading,
            'info'=>$request->info
        ]);
        return redirect()->back()->with('message','Settings saved successfully!');

    }
}
