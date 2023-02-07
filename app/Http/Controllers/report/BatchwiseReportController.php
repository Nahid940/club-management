<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class BatchwiseReportController extends Controller
{
    //

    public function index()
    {
        $passing_years=Member::select('passing_year')->distinct()->orderBy('passing_year','asc')->get();
        return view('reports.batch-wise.index',['passing_years'=>$passing_years,"title"=>""]);
    }

    public function report(Request $request)
    {
        $where = [];
        if($request->has('passing_year') && !empty($request->passing_year) && $request->passing_year>1)
        {
            $where[] =['passing_year','=',$request->passing_year];
        }
        $members=Member::select('first_name','member_code','passing_year','email','registration_date','mobile_number')
            ->where('status',1)
            ->where($where)
            ->orderBy('id','desc')
            ->get();
        return response()->json([
            'html' => view('reports.batch-wise.report',['members'=>$members,'batch'=>$request->passing_year,"title"=>""])->render()
        ]);
    }
}
