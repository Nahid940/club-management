<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    //

    public function index(Request $request)
    {

        $where = [];
        if($request->has('name') && !empty($request->name))
        {
            $where[] =['member_name','LIKE','%'.$request->name.'%'];
        }
        if($request->has('member_code') && !empty($request->member_code))
        {
            $where[] =['member_code','LIKE','%'.$request->member_code.'%'];
        }
        if($request->has('date') && !empty($request->date))
        {
            $where[] =['date','=',$request->date];
        }

        $bills=Billing::where('status',1)->where($where)->orderBy('id','desc')->paginate(24);
        return view('billing.index',['title'=>"",'bills'=>$bills]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'member_id'=>'required',
            'lounge_cash_amount'=>'numeric',
            'lounge_card_amount'=>'numeric',
            'restaurant_cash_amount'=>'numeric',
            'restaurant_card_amount'=>'numeric',
            'date'=>'required',
        ]);
        if(!isset($request->guest_bill))
        {
            $member_info=Member::where('id',$request->member_id)->select('id','first_name','member_code','email','mobile_number')->first();
            Billing::create([
                'member_name'=>$member_info->first_name,
                'member_id'=>$member_info->id,
                'member_code'=>$member_info->member_code,
                'lounge_cash_amount'=>$request->lounge_cash_amount,
                'lounge_card_amount'=>$request->lounge_card_amount,
                'restaurant_cash_amount'=>$request->restaurant_cash_amount,
                'restaurant_card_amount'=>$request->restaurant_card_amount,
                'date'=>$request->date,
                'payment_ref_no'=>$request->payment_ref_no,
                'remarks'=>$request->remarks,
                'created_at'=>Carbon::now(),
                'created_by'=>Auth::user()->id
            ]);
            return redirect()->back()->with('message','Bill saved successfully');
        }else
        {
            Billing::create([
                'member_name'=>$request->person_name,
                'member_id'=>0,
                'member_code'=>0,
                'lounge_cash_amount'=>$request->lounge_cash_amount,
                'lounge_card_amount'=>$request->lounge_card_amount,
                'restaurant_cash_amount'=>$request->restaurant_cash_amount,
                'restaurant_card_amount'=>$request->restaurant_card_amount,
                'date'=>$request->date,
                'payment_ref_no'=>$request->payment_ref_no,
                'remarks'=>$request->remarks,
                'created_at'=>Carbon::now(),
                'created_by'=>Auth::user()->id
            ]);
            return redirect()->back()->with('message','Bill saved successfully');
        }

    }

    public function edit($id)
    {
        $bill=Billing::where('id',$id)->first();
        return view('billing.edit',['title'=>"",'bill'=>$bill]);
    }

    public function view($id)
    {
        $bill=Billing::where('id',$id)->first();
        return view('billing.view',['title'=>"",'bill'=>$bill]);
    }

    public function delete(Request $request)
    {
        Billing::where('id',$request->id)->delete();
        return redirect()->back()->with('message','Bill deleted successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'member_id'=>'required',
            'date'=>'required',
        ]);
        Billing::where('id',$request->bill)->update([
            'lounge_cash_amount'=>$request->lounge_cash_amount,
            'lounge_card_amount'=>$request->lounge_card_amount,
            'restaurant_cash_amount'=>$request->restaurant_cash_amount,
            'restaurant_card_amount'=>$request->restaurant_card_amount,
            'date'=>$request->date,
            'payment_ref_no'=>$request->payment_ref_no,
            'remarks'=>$request->remarks,
            'updated_at'=>Carbon::now(),
            'updated_by'=>Auth::user()->id,
        ]);
        return redirect()->back()->with('message','Bill updated successfully');
    }

    public function report()
    {
        return view('billing.report-index',['title'=>""]);
    }

    public function getReport(Request $request)
    {
        $where = [];
        if($request->has('member') && !empty($request->member))
        {
            $where[] =['member_code','=',$request->member];
        }
        if($request->has('date_from') && !empty($request->date_from))
        {
            $where[] =['date','>=',$request->date_from];
        }
        if($request->has('date_to') && !empty($request->date_to))
        {
            $where[] =['date','<=',$request->date_to];
        }
        $date_from=$request->date_from;
        $date_to=$request->date_to;
        $bills=Billing::where('status',1)->where($where)->orderBy('id','desc')->get();
        return response()->json([
            'html' => view('billing.report',["bills"=>$bills,'date_from'=>$date_from,'date_to'=>$date_to])->render()
        ]);
    }


}
