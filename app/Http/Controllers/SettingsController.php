<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //

    public function index()
    {
        $title="";
        return view('pages.settings.settings',['title'=>$title]);
    }
}
