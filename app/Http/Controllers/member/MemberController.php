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
        $today=date('Y-m-d');
        return view('pages.member.admission',['title' => "",'today'=>$today]);
    }

    public function save(MemberAdmissionRequest $request)
    {
        $data=$this->memberInfo->getPostedData($request);
        $insert_id=$this->memberInfo->addMember($data);
        if(!empty($insert_id))
        {
            $message="Member added successfully!!";
            return redirect()->route('member-admission')->with(['message' => $message,'id'=>$insert_id]);
        }
    }
}
