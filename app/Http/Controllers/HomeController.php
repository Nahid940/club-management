<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    //

    public function index()
    {
        $pageTitle="Dashboard";
        return view('pages.home',['title'=>$pageTitle]);
    }

}
