<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberPaymentController extends Controller
{
    //

    public function index()
    {

        return view('pages.payment.member-payment-index',['title'=>""]);
    }
}
