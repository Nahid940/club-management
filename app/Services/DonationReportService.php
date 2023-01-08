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
            $where[]=['payment_date','>=',$data->date_from];
        }

        if(!empty($data->date_to))
        {
            $where[]=['payment_date','<=',$data->date_to];
        }

        if(!empty($data->payment_method))
        {
            $where[]=['payment_method','=',$data->payment_method];
        }

        $payments=Payment::where($where)
            ->where('payment_type',2)
            ->where('status',1)
            ->select('id','member_id','payment_date','amount')
            ->get();
        $members=Donor::select('name','id')->where('status',1)->get();

        $report_data=array();

        foreach ($payments as $payment)
        {
            $report_data[$payment->member_id]['payment'][$payment->id]['amount']=$payment->amount;
            $report_data[$payment->member_id]['payment'][$payment->id]['payment_date']=$payment->payment_date;
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