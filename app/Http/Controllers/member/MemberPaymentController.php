<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberPaymentController extends Controller
{
    //

    public function index(Request $request)
    {
        $payments=array();
        $where = [];
        if($request->has('trx_id') && !empty($request->trx_id))
        {
            $where[] =['id','=',$request->trx_id];
        }
        if($request->has('payment_date') && !empty($request->payment_date))
        {
            $where[] =['payment_date','=',$request->payment_date];
        }
        $member_id=Member::where('user_id',Auth::user()->id)->select('id')->first();
        if(empty($member_id))
        {
            return view('pages.payment.member-payment-index',["title"=>""]);
        }
        $where[]=['member_id',$member_id->id];
        $where[]=['payment_type',1];
        if(!empty($member_id))
        {
            $payments=Payment::where($where)->orderBy('id','desc')->paginate(20);
        }
        return view('pages.payment.member-payment-index',['title'=>"","payments"=>$payments]);
    }

    public function view($id)
    {
        $member_id=Member::where('user_id',Auth::user()->id)->select('id')->first();
        $payment=Payment::with('member:id,first_name,member_code,email,member_type,mobile_number')
            ->where('member_id',$member_id->id)
            ->where('payment_type',1)
            ->findOrFail($id);
        return view('pages.payment.view',["payment"=>$payment,"title"=>""]);
    }
}
