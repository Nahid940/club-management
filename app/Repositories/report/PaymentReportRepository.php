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
use Illuminate\Support\Facades\DB;

class PaymentReportRepository implements PaymentReportInterface
{

    public function report($request)
    {
        $where=[];
        if(!empty($request->member))
        {
            $where[]=['member_id','=',$request->member];
        }
        if(!empty($request->date_from))
        {
            $where[]=['payment_date','>=',$request->date_from];
        }

        if(!empty($request->date_to))
        {
            $where[]=['payment_date','<=',$request->date_to];
        }

        if(!empty($request->payment_method))
        {
            $where[]=['payment_method','=',$request->payment_method];
        }

        if(!empty($request->purpose))
        {
            $where[]=['purpose_id','=',$request->purpose];
        }

        $payments=Payment::where($where)
            ->where('payments.status',1)
            ->where('is_payment',1)
            ->leftJoin('payment_types','payment_types.id','payments.payment_type')
            ->select('payments.id','member_id','payment_date','amount','payment_types.name')
            ->get();

        if(!empty($request->member))
        {
            $members=Member::select('first_name','id')->where('id',$request->member)->get();
        }else
        {
            $members=Member::select('first_name','id')->where('status',1)->get();
        }

        $report_data=array();

        foreach ($payments as $payment)
        {
            $report_data[$payment->member_id]['payment'][$payment->id]['amount']=$payment->amount;
            $report_data[$payment->member_id]['payment'][$payment->id]['payment_date']=$payment->payment_date;
            $report_data[$payment->member_id]['payment'][$payment->id]['payment_type']=$payment->name;
        }

        foreach ($members as $member)
        {
            if(isset($report_data[$member->id]))
            {
                $report_data[$member->id]['id']=$member->id;
                $report_data[$member->id]['name']=$member->first_name;
            }
        }
        return $report_data;
    }
}