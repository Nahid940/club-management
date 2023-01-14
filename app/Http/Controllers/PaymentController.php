<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Mail\MemberPaymentMail;
use App\Models\EmailConfig;
use App\Models\Payment;
use App\Models\PaymentType;
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
            ->orderBy('id','desc')
            ->where('status','!=','-2')
            ->whereHas('member', function ($query) use ($where){
                $query->where($where);
            })
            ->paginate(15);
        return view('pages.payment.index')->with(['title'=>$title,'payments'=>$payments]);
    }
    public function view($id){
        $title="";
        $payment=Payment::info()->findOrFail($id);
        return view('pages.payment.view',["payment"=>$payment,"title"=>$title]);
    }

    public function add()
    {   $title="";
        $payment_types=PaymentType::select('id','name')->get();
        return view('pages.payment.add')->with(['title'=>$title,"payment_types"=>$payment_types]);
    }

    public function save(PaymentRequest $request)
    {
        $id=Payment::insertGetId([
            "member_id"=>$request->member_id,
            "payment_type"=>$request->payment_type,
            "payment_date"=>$request->date,
            "amount"=>$request->amount,
            "currency_rate"=>1,
            "currency"=>"BDT",
            "payment_method"=>$request->payment_method,
            "payment_ref_no"=>$request->payment_ref_no,
            "remarks"=>$request->remarks,
            "payment_month"=>$request->month,
            "payment_year"=>$request->year,
            "created_at"=>Carbon::now(),
            "created_by"=>Auth::user()->id
        ]);
        return redirect()->back()->with(['message'=>'Payment saved successfully!',"id"=>$id]);
    }

    public function process(Request $request)
    {
        if(!empty($request->process_payment) && !empty($request->action_type))
        {
            if($request->action_type==1)
            {
                $email_config=EmailConfig::select('send_payment_approval_email')->first();
                Payment::where('id',$request->process_payment)->update(['status'=>1]);
                $payment=Payment::with('member:id,first_name,member_code,email')->findOrFail($request->process_payment);
                if(isset($email_config->send_payment_approval_email) && !empty($email_config->send_payment_approval_email) && $email_config->send_payment_approval_email==1)
                {
                    Mail::to($payment->member->email)->queue(new MemberPaymentMail($payment));
                }
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
        $payment_types=PaymentType::select('id','name')->get();
        $payment=Payment::with('member:id,first_name,member_code,email,member_type,mobile_number')->findOrFail($id);
        return view('pages.payment.edit')->with(['title'=>$title,'payment'=>$payment,"payment_types"=>$payment_types]);
    }

    public function update(PaymentRequest $request)
    {
        Payment::where('id',$request->payment_sl)->update([
            "member_id"=>$request->member_id,
            "payment_type"=>$request->payment_type,
            "payment_date"=>$request->date,
            "amount"=>$request->amount,
            "payment_method"=>$request->payment_method,
            "payment_ref_no"=>$request->payment_ref_no,
            "remarks"=>$request->remarks,
            "payment_month"=>$request->month,
            "payment_year"=>$request->year,
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

    public function paymentTypes()
    {
        $types=PaymentType::where('status',1)->paginate(10);
        return view('pages.payment.payment_types',['types'=>$types,"title"=>""]);
    }

    public function typeDelete(Request $request)
    {
        if(!empty($request->id)) {
            PaymentType::where('id', $request->id)->update(['status' => -2]);//delete
            return redirect()->back()->with('message','User deleted successfully!!');
        }
    }

    public function typeStatus(Request $request)
    {
        if(!empty($request->status) && $request->status==1) {
            PaymentType::where('id', $request->id)->update(['status' => 0]);
            return redirect()->back()->with('message','User inactivated successfully!!');
        }else if(!empty($request->status) && $request->status==1)
        {
            PaymentType::where('id', $request->id)->update(['status' => 1]);
            return redirect()->back()->with('message','User activated successfully!!');
        }
    }

    public function typeAdd(Request $request)
    {
        return view('pages.payment.new_payment_type',["title"=>""]);
    }


    public function typeSave(Request $request)
    {
        PaymentType::create($request->all());
        return redirect()->back()->with('message','Type added successfully!!');
    }
}
