<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Occupation;
use Illuminate\Http\Request;

class ProfessionWiseReportController extends Controller
{
    //

    public function index()
    {
        $occupations=Occupation::select('id','occupation')->get();
        return view('reports.profession.index',["occupations"=>$occupations,"title"=>""]);
    }

    public function report(Request $request)
    {
        $where = [];
        if($request->has('profession') && !empty($request->profession) && $request->profession>0)
        {
            $where[] =['members.occupation','=',$request->profession];
            $occupation=Occupation::select('occupation')->where('id',$request->profession)->first();
        }else{
            $occupation=[];
        }

        $members=Member::select('first_name','member_code','passing_year','email','registration_date','mobile_number','occupations.occupation')
            ->leftJoin('occupations','occupations.id','=','members.occupation')
            ->where('status',1)
            ->where($where)
            ->orderBy('members.id','desc')
            ->get();
        return response()->json([
            'html' => view('reports.profession.report',["members"=>$members,'occupation'=>$occupation])->render()
        ]);
    }
}
