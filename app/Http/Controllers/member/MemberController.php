<?php

namespace App\Http\Controllers\member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberAdmissionRequest;
use App\Interfaces\MemberInterface;

class MemberController extends Controller
{
    //
    private $memberInfo; 

    public function __construct(MemberInterface $memberInfo)
    {
        $this->memberInfo=$memberInfo;
    }

    public function index()
    {
        $pageTitle="Member List";
        return view('pages.member.index',['title' => $pageTitle]);
    }

    public function read($id)
    {
        $member=$this->memberInfo->getMember($id);
        return view('pages.member.view',['title' => ""]);
    }

    public function admission()
    {
        return view('pages.member.admission',['title' => ""]);
    }

    public function save(MemberAdmissionRequest $request)
    {
        $this->getPostedDate($request);
    }

    public function getPostedDate($request)
    {
        $validated = $request->validated();
        
        $data['name']=$validated['name'];
        $data['member_type']=$validated['member_type'];
        $data['blood_group']=$request->member_type;
        $data['college_roll']=$request->college_roll;
        $data['date_of_birth']=$validated['date_of_birth'];
        $data['nid']=$validated['nid'];
        $data['passport']=$request->passport;
        $data['marital_status']=$request->marital_status;
        $data['date_of_annniversary']=$request->date_of_annniversary;
        $data['no_of_dependants']=$request->no_of_dependants;
        $data['fathers_name']=$request->fathers_name;
        $data['mothers_name']=$request->mothers_name;
        $data['mobile_number']=$validated['mobile_number'];
        $data['email']=$request->email;
        $data['occupation_type']=$request->occupation_type;
        $data['institution_name']=$request->institution_name;
        $data['passing_year']=$request->passing_year;
        $data['degree']=$request->degree;
        $data['present_address']=$validated['present_address'];
        $data['permanent_address']=$request->permanent_address;
        $data['company_name']=$request->company_name;
        $data['designation']=$request->designation;
        $data['office_address']=$request->office_address;
        $data['office_phone']=$request->office_phone;
        $data['office_mobile']=$request->office_mobile;
        $data['all_correspondence']=$request->all_correspondence;
        $data['should_be_sent_to']=$request->should_be_sent_to;
        dd($data);
    }
}
