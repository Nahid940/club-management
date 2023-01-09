<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Notice;
use App\Models\Payment;
use App\Models\User;
use App\Models\User_setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    //

    public function index()
    {
        $pageTitle="";
        if(Auth::user()->hasRole('member'))
        {
            $payment_summery=array();
            $member_info=Member::where('user_id',Auth::user()->id)->select('id','first_name','registration_date','member_type','member_photo')->first();
            if(!empty($member_info))
            {
                $payment_summery=DB::table('payments')->select(DB::raw('MAX(payment_date) as payment_date,SUM(amount) as amount'))
                    ->where('member_id',$member_info->id)
                    ->where('status',1)
                    ->where('payment_type',1)
                    ->first();
            }

            $notices=Notice::where('status',1)->orderBy('id', 'desc')->paginate(5);
            return view('pages.home',['title'=>$pageTitle,'notices'=>$notices,'info'=>$member_info,'payment'=>$payment_summery]);
        }else
        {
            $date=Carbon::today()->toDateString();
            $active_member=Member::where('status',1)->count();
            $this_month_new_member=Member::whereMonth('registration_date','=',date('m',strtotime($date)))
                ->whereYear('registration_date','=',date('Y',strtotime($date)))
                ->where('status',1)
                ->count();

            $new_member_application=Member::where('status',-1)->count();
            $total_payment=Payment::where('status',1)->where('payment_type',1)->sum('amount');

            return view('pages.home',['title'=>$pageTitle],["today"=>$date,"active_member"=>$active_member,
                "this_month_new_member"=>$this_month_new_member,"new_member_application"=>$new_member_application,
                "total_payment"=>$total_payment]);
        }
    }

}
