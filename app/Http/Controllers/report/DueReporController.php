<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MembershipType;
use App\Services\DueCalculationService;
use Illuminate\Http\Request;

class DueReporController extends Controller
{
    //

    protected $due_calculation;

    public function __construct(DueCalculationService $due_calculation)
    {
        $this->due_calculation=$due_calculation;
    }


    public function getMembershipWiseDueIndex()
    {
        $member_types=MembershipType::select('id','type_name')->where('status',1)->get();
        return view('reports.membershipdue.index',['title'=>'','member_types'=>$member_types]);
    }

    public function getMembershipWiseDue(Request $request)
    {
        $report_data=$this->due_calculation->getMembershipDue($request);
        $type_name="";
        if(!empty($request->membership_type) && $request->membership_type>0)
        {
            $type_name=MembershipType::where('id',$request->membership_type)->select('type_name')->first();
        }
        return response()->json([
            'html' => view('reports.membershipdue.report',["membership_dues"=>$report_data,"type_name"=>$type_name])->render()
        ]);
    }

    public function getMemberWiseDueIndex()
    {
        $members=Member::select('id','first_name','member_code')->where('status',1)->get();
        return view('reports.member-wise-due.index',['title'=>'',"members"=>$members]);
    }

    public function getMemberWiseDue(Request $request)
    {
        $report_data=$this->due_calculation->getMembersDueData($request);
//        echo "<pre>";print_r($report_data);die;
        return response()->json([
            'html' => view('reports.member-wise-due.report',["report_data"=>$report_data])->render()
        ]);
    }

    public function memberFeeDueIndex()
    {
        $members=Member::select('id','first_name','member_code')->where('status',1)->get();
        return view('reports.member-fee.index',['title'=>'','members'=>$members]);
    }

    public function memberFeeDueReport(Request $request)
    {
        $report_data=$this->due_calculation->getMemberFeeDueReport($request);
//        echo "<pre>";print_r($report_data);die;
        return response()->json([
            'html' => view('reports.member-fee.report',["report_data"=>$report_data])->render()
        ]);
    }
}
