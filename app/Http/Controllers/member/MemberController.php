<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function index()
    {

        $pageTitle="Member List";
        return view('pages.member.index',['title' => $pageTitle]);
    }

    public function admission()
    {
        $pageTitle="New member admission";
        return view('pages.member.admission',['title' => $pageTitle]);
    }
}
