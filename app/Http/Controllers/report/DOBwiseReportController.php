<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class DOBwiseReportController extends Controller
{
    //

    public function index()
    {
        return view('reports.dob.index',['title'=>'']);
    }

    public function report(Request $request)
    {
        $where = [];
        $date_of_birth="";
        if($request->has('date_of_birth') && !empty($request->date_of_birth))
        {
            $where[] =['members.date_of_birth','=',$request->date_of_birth];
            $date_of_birth=$request->date_of_birth;
        }

        $members=Member::select('first_name','member_code','email','registration_date','mobile_number','date_of_birth')
            ->where('status',1)
            ->where($where)
            ->orderBy('members.id','desc')
            ->get();
        return response()->json([
            'html' => view('reports.dob.report',["members"=>$members,'date_of_birth'=>$date_of_birth])->render()
        ]);
    }
}
