<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function index()
    {   $title="Payments";
        return view('pages.payment.index')->with(['title'=>$title]);
    }
}
