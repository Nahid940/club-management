<?php
/**
 * Created by PhpStorm.
 * User: nahid
 * Date: 3/10/23
 * Time: 9:47 PM
 */

namespace App\Services;


use Illuminate\Support\Facades\DB;

class MembershipFeeSchedule
{

    public function fees($id)
    {
        $fees=DB::table('membership_fees')
            ->where('membership_type_id',$id)
            ->orderBy('id','asc')->get();
        $schedule_fees=array();
        $i=1;
        foreach ($fees as $fee)
        {
            $from_year=date('Y',strtotime($fee->effective_from));
            $from_month=intval(date('m',strtotime($fee->effective_from)));

            $to_year=empty($fee->closing_date)?date('Y',strtotime(date('Y-m-d'))):date('Y',strtotime($fee->closing_date));
            $to_month=empty($fee->closing_date)?date('m',strtotime(date('Y-m-d'))):intval(date('m',strtotime($fee->closing_date)));

            $monthly_fee=$fee->monthly_fee;

            for ($year = $from_year; $year <= $to_year; $year++) {
                $start_month = ($year == $from_year) ? $from_month : 1;
                $end_month = ($year == $to_year) ? $to_month : 12;
                for ($month = $start_month; $month <= $end_month; $month++) {
                    $schedule_fees[$i][$year][$month]=$monthly_fee;
                }
            }
            $i++;
        }
        return $schedule_fees;
    }

}