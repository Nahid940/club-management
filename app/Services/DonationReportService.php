<?php
/**
 * Created by PhpStorm.
 * User: nahid
 * Date: 1/8/23
 * Time: 10:45 PM
 */

namespace App\Services;


use App\Models\Donor;
use App\Models\Member;
use App\Models\Payment;

class DonationReportService
{


    public function report($data)
    {
        $report_data=array();

        $where=[];
        if(!empty($data->date_from))
        {
            $where[]=['payments.payment_date','>=',$data->date_from];
        }

        if(!empty($data->date_to))
        {
            $where[]=['payments.payment_date','<=',$data->date_to];
        }

        if(!empty($data->payment_method))
        {
            $where[]=['payment_method','=',$data->payment_method];
        }

        $payments=Payment::where($where)
            ->where('payments.is_payment','=','0')
            ->where('payments.status',1)
            ->join('payment_details','payment_details.payment_id','=','payments.id')
            ->select('payments.id','payments.member_id','payments.payment_date','amount')
            ->get();
        $report_data=array();
        $member_id=array();
        foreach ($payments as $payment)
        {
//            $report_data[$payment->member_id]['payment'][$payment->id]['id']=$payment->id;
            $report_data[$payment->member_id]['payment'][$payment->id]['amount']=$payment->amount;
            $report_data[$payment->member_id]['payment'][$payment->id]['payment_date']=$payment->payment_date;
            $member_id[$payment->member_id]=$payment->member_id;
        }

        if($data->donation_by==1)
        {
            $members=Donor::select('name','id')->where('status',1)->whereIn('id',$member_id)->get();
        }else
        {
            $members=Member::select('first_name as name','id')->where('status',1)->whereIn('id',$member_id)->get();
        }

        foreach ($members as $member)
        {
            if(isset($report_data[$member->id]))
            {
                $report_data[$member->id]['id']=$member->id;
                $report_data[$member->id]['name']=$member->name;
            }
        }
        return $report_data;
    }

}