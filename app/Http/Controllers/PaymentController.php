<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function index()
    {   $title="";
        return view('pages.payment.index')->with(['title'=>$title]);
    }

    public function add()
    {   $title="";
        return view('pages.payment.add')->with(['title'=>$title]);
    }
}
