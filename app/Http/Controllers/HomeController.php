<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\User;
use App\Models\User_setting;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    //

    public function index()
    {
        $pageTitle="";
        $notices=Notice::orderBy('id', 'desc')->take(5)->get();
        return view('pages.home',['title'=>$pageTitle,'notices'=>$notices]);
    }

}
