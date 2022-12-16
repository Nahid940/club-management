<?php
use Illuminate\Support\Facades\DB;
if(!function_exists('isAlreadyApplied'))
{
    function isAlreadyApplied($user_id)
    {
        $member_data_exits=DB::table('members')->where('user_id',$user_id)->select('user_id')->first();
        if(!empty($member_data_exits))
        {
            return $member_data_exits->user_id;
        }
    }

    function getMemberShortInfo($user_id)
    {
        $member_id=DB::table('members')->where('user_id',$user_id)->select('id','member_photo')->first();
        return $member_id;
    }
}