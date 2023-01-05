<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Notice;
use App\Models\Payment;
use App\Models\User;
use App\Models\User_setting;
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
            $member_info=Member::where('user_id',Auth::user()->id)->select('id','first_name','registration_date','member_type','member_photo')->first();
            $payment_summery=DB::table('payments')->select(DB::raw('MAX(payment_date) as payment_date,SUM(amount) as amount'))
                ->where('member_id',$member_info->id)
                ->where('status',1)
                ->first();
            $notices=Notice::where('status',1)->orderBy('id', 'desc')->paginate(5);
            return view('pages.home',['title'=>$pageTitle,'notices'=>$notices,'info'=>$member_info,'payment'=>$payment_summery]);
        }else
        {

            return view('pages.home',['title'=>$pageTitle]);
        }
    }

}
