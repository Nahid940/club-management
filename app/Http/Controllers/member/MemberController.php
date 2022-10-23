<?php

namespace App\Http\Controllers\member;

use App\Mail\MemberMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Interfaces\MemberInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\MemberAdmissionRequest;

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
        $data['branch_id']=1;
        $members=$this->memberInfo->getMembers($data);
        return view('pages.member.index',['title' => $pageTitle,'members'=>$members]);
    }

    public function read($id)
    {
        $member=$this->memberInfo->getMember($id);
        // $redis = new Redis();
        // Redis::set('member', $member);
        return view('pages.member.view',['title' => "",'member'=>$member]);
    }

    public function edit($id)
    {
        $member=$this->memberInfo->getMember($id);
        return view('pages.member.edit',['title' => "",'member'=>$member]);
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
            Mail::to(["nahid35@diit.info"])->send(new MemberMail());
            $message="Member added successfully!!";
            return redirect()->route('member-admission')->with(['message' => $message,'id'=>$insert_id]);
        }
    }
}
