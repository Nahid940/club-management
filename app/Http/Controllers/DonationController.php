<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonationRequest;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    //

    public function index(Request $request)
    {
        $title="";
        $where = [];
        if($request->has('name') && !empty($request->name))
        {
            $where[] =['name','LIKE','%'.$request->name.'%'];
        }
        if($request->has('email') && !empty($request->email))
        {
            $where[] =['email','=',$request->email];
        }
        if($request->has('mobile_number') && !empty($request->mobile_number))
        {
            $where[] =['phone','=',$request->mobile_number];
        }
        $payments=Payment::with('donor:id,name,email')
            ->orderBy('id','desc')
            ->where('status','!=','-2')
            ->where('payment_type',2)
            ->whereHas('donor', function ($query) use ($where){
                $query->where($where);
            })
            ->paginate(15);
        return view('pages.donation.index')->with(['title'=>$title,'payments'=>$payments]);
    }

    public function add()
    {
        return view('pages.donation.add',["title"=>""]);
    }

    public function save(DonationRequest $request)
    {
        Payment::create([
            "member_id"=>$request->member_id,
            "payment_type"=>2, //donation
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
        return redirect()->back()->with('message','Donation saved successfully!');
    }

    public function view($id){
        $title="";
        $payment=Payment::with('donor:id,name,email,phone')
            ->where('payment_type',2)
            ->findOrFail($id);
        return view('pages.donation.view',["payment"=>$payment,"title"=>$title]);
    }

    public function delete(Request $request)
    {
        if(!empty($request->payment_id)) {
            Payment::where('id', $request->payment_id)->update(['status' => -2]);//delete
        }
        return redirect()->back()->with('message','Donation data moved to trash!');
    }


    public function edit($id)
    {
        $title="";
        $payment=Payment::with('donor:id,name,email,phone')->findOrFail($id);
        return view('pages.donation.edit')->with(['title'=>$title,'payment'=>$payment]);
    }

    public function update(DonationRequest $request)
    {
        Payment::where('id',$request->payment_sl)->update([
            "member_id"=>$request->member_id,
            "payment_type"=>2,
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
        return redirect()->back()->with('message','Donation data updated successfully!');
    }

    public function process(Request $request)
    {
        if(!empty($request->process_payment) && !empty($request->action_type))
        {
            if($request->action_type==1)
            {
                Payment::where('id',$request->process_payment)->update(['status'=>1]);
                $payment=Payment::with('donor:id,name,email,phone')->findOrFail($request->process_payment);
                return redirect()->back()->with('message','Donation approved successfully!');
            }else if($request->action_type==2)
            {
                Payment::where('id',$request->process_payment)->update(['status'=>-1]);
                return redirect()->back()->with('warning','Donation declined successfully!');
            }else if($request->action_type==3){
                Payment::where('id',$request->process_payment)->update(['status'=>0]);
                return redirect()->back()->with('warning','Donation reverted successfully!');
            }
        }
    }
}
