<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function index()
    {
        $pageTitle="Dashboard";
        return view('pages.home',['title'=>$pageTitle]);
    }

}
