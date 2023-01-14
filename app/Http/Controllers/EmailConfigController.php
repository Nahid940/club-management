<?php

namespace App\Http\Controllers;

use App\Models\EmailConfig;
use Illuminate\Http\Request;

class EmailConfigController extends Controller
{
    //

    public function config()
    {
        $configs=EmailConfig::first();
        return view('pages.email.config',["title"=>"","configs"=>$configs]);
    }

    public function save(Request $request)
    {
        EmailConfig::where('id',$request->id)->delete();
        EmailConfig::create($request->all());
        return redirect()->back()->with('message','Email Configure Updated Successfully!!');
    }
}
