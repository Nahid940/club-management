<?php

namespace App\Http\Controllers;

use App\Exports\PaymentExport;
use App\Http\Requests\PaymentRequest;
use App\Mail\MemberPaymentMail;
use App\Models\DonationPurpose;
use App\Models\EmailConfig;
use App\Models\Payment;
use App\Models\PaymentType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

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

        if($request->has('member_code') && !empty($request->member_code))
        {
            $where[] =['member_code','=',$request->member_code];
        }
        if($request->has('purpose') && !empty($request->purpose))
        {
            $where[] =['purpose_id','=',$request->purpose];
        }
        $payments=Payment::with('member:id,first_name,member_code,email')
            ->orderBy('id','desc')
            ->where('status','!=','-2')
            ->where('is_payment','=','1')
            ->whereHas('member', function ($query) use ($where){
                $query->where($where);
            })
            ->paginate(15);
        $purposes=DonationPurpose::select('id','purpose')->where('status',1)->get();
        return view('pages.payment.index')->with(['title'=>$title,'payments'=>$payments,'purposes'=>$purposes]);
    }
    public function view($id){
        $title="";
        $payment=Payment::info()->findOrFail($id);
        return view('pages.payment.view',["payment"=>$payment,"title"=>$title]);
    }

    public function add()
    {   $title="";
        $payment_types=PaymentType::select('id','name')->where('status',1)->get();
        $donation_purpose=DonationPurpose::select('id','purpose')->where('status',1)->get();
        return view('pages.payment.add')->with(['title'=>$title,"payment_types"=>$payment_types,"donation_purposes"=>$donation_purpose]);
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
            "purpose_id"=>$request->purpose_id,
            "payment_month"=>$request->month,
            "payment_year"=>$request->year,
            "created_at"=>Carbon::now(),
            "created_by"=>Auth::user()->id,
            "is_payment"=>1
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
        $donation_purpose=DonationPurpose::select('id','purpose')->where('status',1)->get();
        $payment_types=PaymentType::select('id','name')->get();
        $payment=Payment::with('member:id,first_name,member_code,email,member_type,mobile_number')->findOrFail($id);
        return view('pages.payment.edit')->with(['title'=>$title,'payment'=>$payment,"payment_types"=>$payment_types,"donation_purposes"=>$donation_purpose]);
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
            "purpose_id"=>$request->purpose_id,
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
        $validated = $request->validate([
            'name' => 'required|max:60',
        ]);
        PaymentType::create($request->all());
        return redirect()->back()->with('message','Type added successfully!!');
    }

    public function export()
    {
        $types=PaymentType::where('status',1)->get();
        return view('pages.payment.export',["title"=>"","payment_types"=>$types]);
    }

    public function getExportFile(Request $request)
    {
        $request->validate([
            "date_from"=>"required",
            "date_to"=>"required",
            "payment_type"=>"required"
        ]);
        if($request->has('date_from') && !empty($request->date_from))
        {
            $where[] =['payment_date','>=',$request->date_from];
        }
        if($request->has('date_to') && !empty($request->date_to))
        {
            $where[] =['payment_date','<=',$request->date_to];
        }
        if($request->has('payment_type') && !empty($request->payment_type) && $request->payment_type>0)
        {
            $where[] =['payment_type','=',$request->payment_type];
        }
        $payments=Payment::info()->where('status',1)->where('is_payment','=','1')->where($where)->orderBy('id','desc')->get();
        $data=array();
        foreach ($payments as $payment)
        {
            $data[$payment->id]['name']=isset($payment->member->first_name)?$payment->member->first_name:"";
            $data[$payment->id]['member_code']=isset($payment->member->member_code)?$payment->member->member_code:"";
            $data[$payment->id]['amount']=$payment->amount;
            $data[$payment->id]['payment_date']=$payment->payment_date;
            $data[$payment->id]['payment_month']=date('F',strtotime($payment->payment_month));
            $data[$payment->id]['payment_year']=$payment->payment_year;
            $data[$payment->id]['purpose']=isset($payment->purpose->purpose)?$payment->purpose->purpose:"";
            $data[$payment->id]['donation_for']=isset($payment->purpose->donation_for)?$payment->purpose->donation_for:"";
        }
        $payments=$data;
        if(empty($data))
        {
            return redirect()->back()->with('message','No Data Found To Export!!');
        }
        return Excel::download(new PaymentExport($payments),"payment.xlsx");
    }
}
