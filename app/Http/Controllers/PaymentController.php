<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Mail\MemberPaymentMail;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    //

    public function index(Request $request)
    {   $title="";
        $where = [];
        if($request->has('name') && !empty($request->name))
        {
            $where[] =['first_name','LIKE','%'.$request->name.'%'];
        }
        if($request->has('email') && !empty($request->email))
        {
            $where[] =['email','=',$request->email];
        }
        if($request->has('mobile_number') && !empty($request->mobile_number))
        {
            $where[] =['phone','=',$request->mobile_number];
        }
        $payments=Payment::with('member:id,first_name,member_code,email')
            ->orderBy('id','asc')
            ->where('status','!=','-2')
            ->where('payment_type',1)
            ->whereHas('member', function ($query) use ($where){
                $query->where($where);
            })
            ->paginate(20);
        return view('pages.payment.index')->with(['title'=>$title,'payments'=>$payments]);
    }
    public function view($id){
        $title="";
        $payment=Payment::with('member:id,first_name,member_code,email,member_type,mobile_number')
            ->where('payment_type',1)
            ->findOrFail($id);
        return view('pages.payment.view',["payment"=>$payment,"title"=>$title]);
    }

    public function add()
    {   $title="";
        return view('pages.payment.add')->with(['title'=>$title]);
    }

    public function save(PaymentRequest $request)
    {
        Payment::create([
            "member_id"=>$request->member_id,
            "payment_type"=>1,
            "payment_date"=>$request->date,
            "amount"=>$request->amount,
            "currency_rate"=>1,
            "currency"=>"BDT",
            "payment_method"=>$request->payment_method,
            "payment_ref_no"=>$request->payment_ref_no,
            "remarks"=>$request->remarks,
            "payment_month"=>date('m',strtotime($request->date)),
            "payment_year"=>date('Y',strtotime($request->date)),
            "created_at"=>Carbon::now(),
            "created_by"=>Auth::user()->id
        ]);
        return redirect()->back()->with('message','Payment saved successfully!');
    }

    public function process(Request $request)
    {
        if(!empty($request->process_payment) && !empty($request->action_type))
        {
            if($request->action_type==1)
            {
                Payment::where('id',$request->process_payment)->update(['status'=>1]);
                $payment=Payment::with('member:id,first_name,member_code,email')->findOrFail($request->process_payment);
                Mail::to('nahid940@gmail.com')->queue(new MemberPaymentMail($payment));
                return redirect()->back()->with('message','Payment approved successfully!');
            }else if($request->action_type==2)
            {
                Payment::where('id',$request->process_payment)->update(['status'=>-1]);
                return redirect()->back()->with('warning','Payment declined successfully!');
            }else if($request->action_type==3){
                Payment::where('id',$request->process_payment)->update(['status'=>0]);
                return redirect()->back()->with('warning','Payment reverted successfully!');
            }
        }
    }

    public function edit($id)
    {
        $title="";
        $payment=Payment::with('member:id,first_name,member_code,email,member_type,mobile_number')->findOrFail($id);
        return view('pages.payment.edit')->with(['title'=>$title,'payment'=>$payment]);
    }

    public function update(PaymentRequest $request)
    {
        Payment::where('id',$request->payment_sl)->update([
            "member_id"=>$request->member_id,
            "payment_type"=>1,
            "payment_date"=>$request->date,
            "amount"=>$request->amount,
            "payment_method"=>$request->payment_method,
            "payment_ref_no"=>$request->payment_ref_no,
            "remarks"=>$request->remarks,
            "payment_month"=>date('m',strtotime($request->date)),
            "payment_year"=>date('Y',strtotime($request->date)),
            "updated_at"=>Carbon::now(),
            "updated_by"=>Auth::user()->id
        ]);
        return redirect()->back()->with('message','Payment updated successfully!');
    }

    public function delete(Request $request)
    {
        if(!empty($request->payment_id)) {
            Payment::where('id', $request->payment_id)->update(['status' => -2]);//delete
        }
        return redirect()->back()->with('message','Payment data moved to trash!');
    }
}
