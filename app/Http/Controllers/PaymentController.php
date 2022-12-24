<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function save(PaymentRequest $request)
    {
        $request->merge(['created_at'=>Carbon::now(),'created_by'=>Auth::user()->id]);
        Payment::create([
            "member_id"=>$request->member_id,
            "payment_type"=>1,
            "payment_date"=>$request->date,
            "amount"=>$request->amount,
            "payment_method"=>$request->payment_method,
            "payment_ref_no"=>$request->payment_ref_no,
            "payment_month"=>date('m',strtotime($request->date)),
            "payment_year"=>date('Y',strtotime($request->date)),
            "created_at"=>Carbon::now(),
            "created_by"=>Auth::user()->id
        ]);
        return redirect()->back()->with('message','Payment saved successfully!');
    }
}
