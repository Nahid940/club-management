<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index()
    {

    }

    public function add()
    {
        $pageTitle="Add new user";
        return view('pages.user.add',['title'=>$pageTitle]);
    }

}
