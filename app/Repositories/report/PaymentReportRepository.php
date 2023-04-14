<?php
/**
 * Created by PhpStorm.
 * User: nahid
 * Date: 1/7/23
 * Time: 11:40 PM
 */

namespace App\Repositories\report;


use App\Interfaces\report\PaymentReportInterface;
use App\Models\Member;
use App\Models\Payment;
use App\Models\PaymentDetails;
use Illuminate\Support\Facades\DB;

class PaymentReportRepository implements PaymentReportInterface
{

    public function report($request)
    {
        $where=[];
        if(!empty($request->member))
        {
            $where[]=['payment_details.member_id','=',$request->member];
        }
        if(!empty($request->date_from))
        {
            $where[]=['payment_details.payment_date','>=',$request->date_from];
        }

        if(!empty($request->date_to))
        {
            $where[]=['payment_details.payment_date','<=',$request->date_to];
        }

        if(!empty($request->payment_type))
        {
            $where[]=['payment_details.payment_type','=',$request->payment_type];
        }
//        else
//        {
//            $where[]=['payment_details.payment_type','=',1];
//        }

        $payments=PaymentDetails::where($where)
            ->where('payment_details.status',1)
            ->where('payment_details.is_payment',1)
            ->join('payments','payments.id','=','payment_details.payment_id')
            ->leftJoin('payment_types','payment_types.id','payment_details.payment_type')
            ->select('payment_details.id','payment_id','payment_details.member_id','amount','payment_details.payment_date','payment_types.name','payment_year','payment_month')
            ->orderBy('payment_id','desc')
            ->get();

        $report_data=array();
        $member_id=array();
        foreach ($payments as $payment)
        {
            $report_data[$payment->member_id]['payment'][$payment->id]['amount']=$payment->amount;
            $report_data[$payment->member_id]['payment'][$payment->id]['payment_date']=$payment->payment_date;
            $report_data[$payment->member_id]['payment'][$payment->id]['payment_type']=$payment->name;
            $report_data[$payment->member_id]['payment'][$payment->id]['payment_year']=$payment->payment_year;
            $report_data[$payment->member_id]['payment'][$payment->id]['payment_month']=$payment->payment_month;
            $member_id[$payment->member_id]=$payment->member_id;
        }

        if(!empty($request->member))
        {
            $members=Member::select('first_name','member_code','id')->where('id',$request->member)->whereIn('id',$member_id)->get();
        }else
        {
            $members=Member::select('first_name','member_code','id')->where('status',1)->whereIn('id',$member_id)->get();
        }

        foreach ($members as $member)
        {
            if(isset($report_data[$member->id]))
            {
                $report_data[$member->id]['id']=$member->id;
                $report_data[$member->id]['name']=$member->first_name." (".$member->member_code.")";
            }
        }
//        echo "<pre>";print_r($report_data);echo "</pre>";die;
        return $report_data;
    }
}