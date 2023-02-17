<?php
/**
 * Created by PhpStorm.
 * User: nahid
 * Date: 2/17/23
 * Time: 12:26 AM
 */

namespace App\Services;


use App\Models\Member;
use App\Models\PaymentDetails;
use Illuminate\Support\Facades\DB;

class DueCalculationService
{


    public function getDueOfMember($member_id)
    {
        $admission_fee=Member::where('id',$member_id)->select('admission_fee')->first();
        $total_paid_admission_fees=PaymentDetails::where('member_id',$member_id)
            ->where('payment_type',2)->where('status',1)->sum('amount');
        $admission_fee_due=($admission_fee->admission_fee-$total_paid_admission_fees);


        date_default_timezone_set('Asia/Dhaka');
        $current_date=date('Y-m-d');
        $current_date='2023-02-26';
        $member_monthly_fee=DB::table('membership_fees')->where('status',1)
            ->select('monthly_fee')->first();
        $member_registration_date=Member::where('id',$member_id)->select('registration_date')->first();

//        echo $member_registration_date->registration_date."<br>";
        $startDate = new \DateTime($member_registration_date->registration_date);
        $endDate = new \DateTime($current_date);
        $interval = $endDate->diff($startDate);
        $monthCount = ($interval->y * 12) + $interval->m;

        $increment_month=0;
        if(date('d',strtotime($current_date))>=25)
        {
            $increment_month=1;
        }

        $total_months=($monthCount)+$increment_month;
        if(intval(date('d',strtotime($member_registration_date->registration_date)))>=25 && intval(date('d',strtotime($member_registration_date->registration_date)))<=31)
        {
            $total_months=$total_months-1==0?1:$total_months;
        }
//        echo $total_months;die;
        $totalPayment=PaymentDetails::where('payment_type',1)->where('is_payment',1)
            ->where('status',1)->where('member_id',$member_id)->sum('amount');

        $total_payable=$member_monthly_fee->monthly_fee*$total_months;

        $due=($total_payable-$totalPayment)+$admission_fee_due;
        if($due>0)
        {
            return number_format($due,2,'.',',');
        }else
        {
            return 0;
        }
    }



    public function getDues()
    {

    }
}