<?php

namespace App\Http\Controllers\member;

use App\Http\Requests\MemberProfileUpdateRequest;
use App\Mail\MemberMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Interfaces\MemberInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\MemberAdmissionRequest;
use App\Http\Requests\MemberDeleteRequest;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\View;

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
//        $redis = new Redis();
//        $member_object=[
//            "name"=>$member->first_name,
//            "email"=>$member->email,
//            "phone"=>$member->phone_number
//        ];
//        $redis::set('member',json_encode($member_object));
        return view('pages.member.view',['title' => "",'member'=>$member]);
    }

    public function profile()
    {
        $id=Auth::user()->id;
        $member=$this->memberInfo->getProfile($id);
        if(!$member)
        {
            return redirect()->route('member-admission')->with(['warning'=>'Your are not a member yet. Please submit your application!']);
        }
        return view('pages.member.view',['title' => "",'member'=>$member]);
    }


    public function edit($id)
    {
        $member=$this->memberInfo->getMember($id);
        return view('pages.member.edit',['title' => "",'member'=>$member]);
    }

    public function memberProfileUpdate()
    {
        $id=Auth::user()->id;
        $member=$this->memberInfo->getProfile($id);
        return view('pages.member.edit',['title' => "",'member'=>$member]);
    }

    public function updateProfile(MemberProfileUpdateRequest $request)
    {
        $id=Auth::user()->id;
        $member_short_info=getMemberShortInfo($id);
        $request->merge(['member_id' => $member_short_info->id,'updated_by'=>$id,'member_old_photo'=>$member_short_info->member_photo]);
        $data=$this->memberInfo->getPostedData($request);
        $this->memberInfo->updateProfile($data);
        return redirect()->route('member-profile')->with('message','Profile updated successfully!');
    }

    public function admission()
    {
        $user=Auth::user();
        $is_member=$user->hasRole('member');
        $is_already_applied=isAlreadyApplied($user->id);
        if($is_member && $is_already_applied)
        {
            return view('pages.member.error',['title' => ""]);
        }else
        {
            $today=date('Y-m-d');
            return view('pages.member.admission',['title' => "",'today'=>$today]);
        }
    }

    public function save(MemberAdmissionRequest $request)
    {
        $data=$this->memberInfo->getPostedData($request);
        $insert_id=$this->memberInfo->addMember($data);
        if(!empty($insert_id))
        {
//            Mail::to(["nahid35@diit.info"])->send(new MemberMail());
            $message="Member added successfully!!";
            return redirect()->route('member-admission')->with(['message' => $message,'id'=>$insert_id]);
        }
    }

    public function delete(MemberDeleteRequest $request)
    {
       $id=$request->member_id;
       $this->memberInfo->deleteMember($id);
       $message="Member moved to trash!!";
       return redirect()->route('member-index')->with(['message' => $message]);
    }
}
