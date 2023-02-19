<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class BloodGroupWiseReportController extends Controller
{
    //

    public function index()
    {
        return view('reports.blood-group.index',['title'=>""]);
    }

    public function report(Request $request)
    {
        $where = [];
        $blood_group="";
        if($request->has('blood_group') && !empty($request->blood_group))
        {
            $where[] =['members.blood_group','=',$request->blood_group];
            $blood_group=$request->blood_group;
        }

        $members=Member::select('first_name','member_code','passing_year','email','registration_date','mobile_number','blood_group')
            ->where('status',1)
            ->where($where)
            ->orderBy('members.id','desc')
            ->get();
        return response()->json([
            'html' => view('reports.blood-group.report',["members"=>$members,'blood_group'=>$blood_group])->render()
        ]);
    }
}
