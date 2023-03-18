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
        $fees_schedule=new MembershipFeeSchedule();
        $admission_fee=Member::where('id',$member_id)->select('admission_fee','member_type')->first();
        $total_paid_admission_fees=PaymentDetails::where('member_id',$member_id)
            ->where('payment_type',2)->where('status',1)->sum('amount');
        $admission_fee_due=($admission_fee->admission_fee-$total_paid_admission_fees);


        date_default_timezone_set('Asia/Dhaka');
        $current_date=date('Y-m-d');
        $current_year=date('Y');
        $current_month=date('m');

        $member_monthly_fee=DB::table('membership_fees')->where('status',1)
            ->where('membership_type_id',$admission_fee->member_type)
            ->select('monthly_fee')->first();
        $member_registration_date=Member::where('id',$member_id)->select('registration_date')->first();

        if(date('d',strtotime($member_registration_date->registration_date))>=25)
        {
            $date1=date('Y-m-01',strtotime('+1 month',strtotime($member_registration_date->registration_date)));
        }else
        {
            $date1=date('Y-m-01',strtotime($member_registration_date->registration_date));
        }

        if(date('d',strtotime($current_date))<25)
        {
            $date2=date('Y-m-t',strtotime('-1 month',strtotime($current_date)));
        }else
        {
            $date2=date('Y-m-t',strtotime($current_date));
        }

        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);
        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);
        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);
//        $diff = ((($year2 - $year1) * 12) + ($month2 - $month1))+1;
//        $increment_month=0;
//        $total_months=($diff);


        $fees=$fees_schedule->fees($admission_fee->member_type);
        $total_payable=0;
        for ($year = $year1; $year <= $year2; $year++) {
            $start_month = ($year == $year1) ? $month1 : 1;
            $end_month = ($year == $year2) ? $month2 : 12;
            for ($month = $start_month; $month <= $end_month; $month++) {
                $month=intval($month);
                if(sizeof($fees)>0)
                {
                    foreach ($fees as $key=>$fee)
                    {
                        if(isset($fees[$key][$year][$month]))
                        {
                            $total_payable+=$fees[$key][$year][$month];//echo $year."==".$month."==".$fees[$key][$year][$month]."<br>";
                        }
                    }
                }
            }
        }
//        echo $total_payable;
//        die;

        $total_payment=0;
        $advance=0;
        if($total_payable==0)
        {
            $total_payment=0;
        }else
        {
            $totalPayment=PaymentDetails::where('payment_type',1)->where('is_payment',1)
                ->where('status',1)->where('member_id',$member_id)
                ->where('payment_year','<=',$current_year)
                ->selectRaw('SUM(amount) as amount,payment_year,payment_month')
                ->groupBy('payment_year')
                ->groupBy('payment_month')
                ->get();
            foreach ($totalPayment as $pymnt)
            {
                if($pymnt->payment_year>=$current_year && $pymnt->payment_month>=intval($current_month))
                {
                    if(date('m',strtotime($current_date))==$pymnt->payment_month)
                    {
                        $total_payment+=$pymnt->amount;
                    }else
                    {
                        $advance+=$pymnt->amount;
                    }
                }else
                {
                    $total_payment+=$pymnt->amount;
                }
            }
        }

        $due=($total_payable-$total_payment)+$admission_fee_due;
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


    public function memberDueCalculation($admission_fee,$member_id,$membership_type_id)
    {
        $total_paid_admission_fees=PaymentDetails::where('member_id',$member_id)
            ->where('payment_type',2)->where('status',1)->sum('amount');
        $admission_fee_due=($admission_fee-$total_paid_admission_fees);

        date_default_timezone_set('Asia/Dhaka');
        $current_date=date('Y-m-d');
        $current_year=date('Y');
        $current_month=date('m');
//        $current_date='2023-02-24';
        $member_monthly_fee=DB::table('membership_fees')->where('status',1)
            ->where('membership_type_id',$membership_type_id)
            ->select('monthly_fee')->first();
        $member_registration_date=Member::where('id',$member_id)->select('registration_date')->first();


        if(date('d',strtotime($member_registration_date->registration_date))>25)
        {
            $date1=date('Y-m-01',strtotime('+1 month',strtotime($member_registration_date->registration_date)));
        }else
        {
            $date1=date('Y-m-01',strtotime($member_registration_date->registration_date));
        }

        if(date('d',strtotime($current_date))<25)
        {
            $date2=date('Y-m-01',strtotime($current_date));
        }else
        {
            $date2=date('Y-m-t',strtotime($current_date));
        }

        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);
        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);
        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);
        $diff = ((($year2 - $year1) * 12) + ($month2 - $month1))+1;
        $increment_month=0;
        $total_months=($diff)+$increment_month;

        $total_months=($total_months)+$increment_month;

        $total_payable=$member_monthly_fee->monthly_fee*$total_months;//echo ($total_payable."-".$totalPayment)."+".$admission_fee_due;die;
        $total_payment=0;
        $advance=0;
        if($total_payable==0)
        {
            $totalPayment=0;
        }else
        {
            $totalPayment=PaymentDetails::where('payment_type',1)->where('is_payment',1)
                ->where('status',1)->where('member_id',$member_id)
                ->where('payment_year','<=',$current_year)
                ->selectRaw('SUM(amount) as amount,payment_year,payment_month')
                ->groupBy('payment_year')
                ->groupBy('payment_month')
                ->get();

            foreach ($totalPayment as $pymnt)
            {
                if($pymnt->payment_year>=$current_year && $pymnt->payment_month>=intval($current_month))
                {
                    if(date('m',strtotime($current_date))==$pymnt->payment_month)
                    {
                        $total_payment+=$pymnt->amount;
                    }else
                    {
                        $advance+=$pymnt->amount;
                    }
                }else
                {
                    $total_payment+=$pymnt->amount;
                }
            }
        }
        $monthly_fee_due=$total_payable-$total_payment;
        return array(
            "membership_fee_due"=>$admission_fee_due,
            "monthly_fee_due"=>$monthly_fee_due,
        );
    }


    public function getMembershipDue($data)
    {
        $where=[];
        if(isset($data->membership_type) && $data->membership_type>0)
        {
            $where[]=['member_type','=',$data->membership_type];
        }
        $members=Member::where('members.status',1)->select('members.id','first_name','member_code','registration_date','member_type','membership_types.type_name as type_name','admission_fee')
            ->leftJoin('membership_types','membership_types.id','=','members.member_type')
            ->where($where)
            ->orderBy('id','desc')
            ->get();

        $report_data=array();
        foreach ($members as $member)
        {
            $due=$this->memberDueCalculation($member->admission_fee,$member->id,$member->member_type);

            if($due['membership_fee_due']+$due['monthly_fee_due']>0)
            {
                $report_data[$member->id]['name']=$member->first_name." (".$member->member_code.")";
                $report_data[$member->id]['registration_date']=$member->registration_date;
                $report_data[$member->id]['membership_type']=$member->type_name;
                $report_data[$member->id]['membership_fee_due']=$due['membership_fee_due'];
                $report_data[$member->id]['monthly_fee_due']=$due['monthly_fee_due'];
            }
        }
        return $report_data;
    }


    public function getMembersDueData($data,$fees_schedule)
    {
        $where=[];
        if(isset($data->member_id) && $data->member_id>0)
        {
            $where[]=['members.id','=',$data->member_id];
            $members=Member::where('members.status',1)
                ->where($where)
                ->select('members.id','first_name','member_code','member_type','registration_date','membership_types.type_name')
                ->join('membership_types','membership_types.id','=','members.member_type')
                ->get();
        }else
        {
            $members=Member::where('members.status',1)
                ->where('short_form','=' ,'UM')
                ->orWhere('short_form', '=','GM')
                ->select('members.id','first_name','member_code','member_type','registration_date','membership_types.type_name')
                ->join('membership_types','membership_types.id','=','members.member_type')
                ->orderBy('members.id','desc')
                ->get();
        }

//        echo "<pre>";print_r($members);die;

        $to_year=$data->to_year;
        $to_month=$data->to_month;

        $members_schedule=array();
        $members_ids=array();
        $members_info=array();
        $member_payable=array();
        foreach ($members as $member)
        {
            $start_year=date('Y',strtotime($member->registration_date));
            $start_month=date('m',strtotime($member->registration_date));
//
            if($start_year>=$data->from_year)
            {
                $from_year=$start_year;
            }else
            {
                $from_year=$data->from_year;
            }

            if($start_month>=$data->from_month)
            {
                $from_month=$start_month;
            }else
            {
                $from_month=$data->from_month;
            }
            $members_info[$member->id]['total_schedule']=0;


            $fees=$fees_schedule->fees($member->member_type);
            $fee_amount=0;
            for ($year = $from_year; $year <= $to_year; $year++) {
                $start_month = ($year == $from_year) ? $from_month : 1;
                $end_month = ($year == $to_year) ? $to_month : 12;
                for ($month = $start_month; $month <= $end_month; $month++) {

                    $month=intval($month);
                    if(sizeof($fees)>0)
                    {
                        foreach ($fees as $key=>$fee)
                        {
                            if(isset($fees[$key][$year][$month]))
                            {
                                $fee_amount=$fees[$key][$year][$month];
                            }
                        }
                    }

                    if(date('m',strtotime($member->registration_date))==$month && date('Y',strtotime($member->registration_date))==$year)
                    {
                        if(date('d',strtotime($member->registration_date))<=25)
                        {
                            $members_schedule[$member->id][$year][intval($month)]=0;
                            $member_payable[$year][intval($month)]=$fee_amount;
                            $members_info[$member->id]['total_schedule']+=1;
                        }
                    }else
                    {
                        $members_schedule[$member->id][$year][intval($month)]=0;
                        $member_payable[$year][intval($month)]=$fee_amount;
                        $members_info[$member->id]['total_schedule']+=1;
                    }
                }
            }
            

            $members_ids[$member->id]=$member->id;
            $members_info[$member->id]['payables']=$member_payable;
            $members_info[$member->id]['first_name']=$member->first_name." (".$member->member_code.")";
            $members_info[$member->id]['registration_date']=$member->registration_date;
            $members_info[$member->id]['type_name']=$member->type_name;
        }

        $payments=PaymentDetails::select('member_id','payment_year','payment_month','amount')
            ->whereIn('member_id',$members_ids)
            ->where('is_payment',1)
            ->where('payment_type',1)
            ->where('payment_year','>=',$data->from_year)
            ->where('payment_year','<=',$to_year)
            ->where('status',1)
            ->get();

        foreach ($payments as $payment)
        {
            if(isset($members_schedule[$payment->member_id]))
            {
                if(isset($members_schedule[$payment->member_id][$payment->payment_year][$payment->payment_month]) && isset($payment->amount) && !empty($payment->amount))
                {
                    $members_schedule[$payment->member_id][$payment->payment_year][$payment->payment_month]+=$payment->amount;
                }
            }
        }
        $report_data=array();
        foreach ($members_schedule as $key=>$schedule)
        {
            $report_data[$key]['name']=$members_info[$key]['first_name'];
            $report_data[$key]['registration_date']=$members_info[$key]['registration_date'];
            $report_data[$key]['type_name']=$members_info[$key]['type_name'];
            $report_data[$key]['total_schedule']=$members_info[$key]['total_schedule'];
            $report_data[$key]['payables']=$members_info[$key]['payables'];
            $report_data[$key]['schedule']=$schedule;

        }

        return $report_data;
    }

    public function getMemberFeeDueReport($data)
    {
        $where=[];
        if(isset($data->member_id) && $data->member_id>0)
        {
            $where[]=['members.id','=',$data->member_id];
            $members=Member::where('members.status',1)
                ->where($where)
                ->where('admission_fee','!=',NULL)
                ->select('members.id','first_name','member_code','registration_date','admission_fee','membership_types.type_name')
                ->join('membership_types','membership_types.id','=','members.member_type')
                ->get();
        }else
        {
            $members=Member::where('members.status',1)
                ->select('members.id','first_name','member_code','registration_date','admission_fee','membership_types.type_name')
                ->where('admission_fee','!=',NULL)
                ->join('membership_types','membership_types.id','=','members.member_type')
                ->orderBy('members.id','desc')
                ->get();
        }
        $total_paid_admission_fees=PaymentDetails::where('payment_type',2)
            ->where('status',1)
            ->groupBy('member_id')
            ->selectRaw('member_id, sum(amount) as amount')
            ->get();
        $payment_array=array();
        foreach ($total_paid_admission_fees as $total_paid_admission_fee)
        {
            $payment_array[$total_paid_admission_fee->member_id]['amount']=$total_paid_admission_fee->amount;
        }
        $report_data=array();
        foreach ($members as $member)
        {
            $report_data[$member->id]['name']=$member->first_name." (".$member->member_code.")";
            $report_data[$member->id]['registration_date']=$member->registration_date;
            $report_data[$member->id]['membership_type']=$member->type_name;
            $report_data[$member->id]['admission_fee']=$member->admission_fee;
            $report_data[$member->id]['paid']=isset($payment_array[$member->id])?$payment_array[$member->id]['amount']:0;
            $report_data[$member->id]['due']=$member->admission_fee-(isset($payment_array[$member->id])?$payment_array[$member->id]['amount']:0);
        }
        return $report_data;
    }



}