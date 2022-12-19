<?php

namespace App\Http\Controllers;

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
        return view('pages.home',['title'=>$pageTitle]);
    }

}
