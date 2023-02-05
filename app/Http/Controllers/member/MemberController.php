<?php

namespace App\Http\Controllers\member;

use App\Http\Requests\MemberProfileUpdateRequest;
use App\Mail\MemberMail;
use App\Models\EmailConfig;
use App\Models\Member;
use App\Models\MemberClassification;
use App\Models\MembershipType;
use App\Models\Occupation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Interfaces\MemberInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\MemberAdmissionRequest;
use App\Http\Requests\MemberDeleteRequest;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Shuchkin\SimpleXLSX;

class MemberController extends Controller
{
    //
    private $memberInfo; 

    public function __construct(MemberInterface $memberInfo)
    {
        $this->memberInfo=$memberInfo;
    }

    public function index(Request $request)
    {
        $pageTitle="Member List";
        $data['branch_id']=1;
        $data['status']=1;
        $data['request_data']=$request->all();
        $members=$this->memberInfo->getMembers($data);
        return view('pages.member.index',['title' => $pageTitle,'members'=>$members]);
    }

    public function newApplications(Request $request)
    {
        $pageTitle="";
        $data['branch_id']=1;
        $data['status']=-1; //-1 for new application
        $data['request_data']=$request->all();
        $members=$this->memberInfo->getMembers($data);
        $occupations=Occupation::select('id','occupation')->get();
        return view('pages.member.new-application',['title' => $pageTitle,'members'=>$members,"occupations"=>$occupations]);
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
        $classifications=MemberClassification::select('id','name')->where('status',1)->get();
        return view('pages.member.view',['title' => "",'member'=>$member,'classifications'=>$classifications]);
    }

    public function newApplicants($id)
    {
        $member=$this->memberInfo->getMember($id);
        return view('pages.member.new-apply',['title' => "",'member'=>$member]);
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
        $occupations=Occupation::select('id','occupation')->get();
        $membership_types=MembershipType::select('membership_types.id','type_name','short_form','admission_fee','monthly_fee')
            ->leftJoin('membership_fees', function ($join) {
                $join->on('membership_type_id', '=', 'membership_types.id')
                    ->where('membership_fees.status', '=', 1);
            })->get();
        return view('pages.member.edit',['title' => "",'member'=>$member,"occupations"=>$occupations,"membership_types"=>$membership_types]);
    }

    public function memberProfileUpdate()
    {
        $id=Auth::user()->id;
        $member=$this->memberInfo->getProfile($id);
        return view('pages.member.edit',['title' => "",'member'=>$member]);
    }

    public function updateProfile(MemberProfileUpdateRequest $request,$member_id)
    {
        $auth_user_id=Auth::user()->id;
        if(!empty($member_id))
        {
            $id=$member_id;
            $member_short_info=Member::select('id','member_photo')->where('id',$id)->first();
            $request->merge(['member_id' => $member_short_info->id,'updated_by'=>$auth_user_id,'member_old_photo'=>$member_short_info->member_photo]);
            $data=$this->memberInfo->getPostedData($request);
            $this->memberInfo->updateProfile($data);
            return redirect()->route('member-read',$member_short_info->id)->with('message','Profile updated successfully!');
        }else
        {
            $id=$auth_user_id;
            $member_short_info=getMemberShortInfo($id);dd($member_short_info);
            $request->merge(['member_id' => $member_short_info->id,'updated_by'=>$auth_user_id,'member_old_photo'=>$member_short_info->member_photo]);
            $data=$this->memberInfo->getPostedData($request);
            $this->memberInfo->updateProfile($data);
            return redirect()->route('member-profile')->with('message','Profile updated successfully!');
        }
    }

    public function admission()
    {
        $user=Auth::user();
        $is_member=$user->hasRole('member');
        $is_already_applied=isAlreadyApplied($user->id);
        $occupations=Occupation::select('id','occupation')->get();
        $membership_types=MembershipType::select('membership_types.id','type_name','short_form','admission_fee','monthly_fee')
            ->leftJoin('membership_fees', function ($join) {
                $join->on('membership_type_id', '=', 'membership_types.id')
                    ->where('membership_fees.status', '=', 1);
            })->get();
        if($is_member && $is_already_applied)
        {
            return view('pages.member.error',['title' => ""]);
        }else
        {
            $today=date('Y-m-d');
            return view('pages.member.admission',['title' => "",'today'=>$today,"occupations"=>$occupations,'membership_types'=>$membership_types]);
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

    public function educationDelete(Request $request)
    {
        return $this->memberInfo->deleteTable($request->id,"member_educations");
    }

    public function clubDelete(Request $request)
    {
        return $this->memberInfo->deleteTable($request->id,"club_memberships");
    }

    public function dependentDelete(Request $request)
    {
        return $this->memberInfo->deleteTable($request->id,"member_dependant_lists");
    }

    public function approve(Request $request)
    {
        $email_config=EmailConfig::select('send_application_approval_email')->first();
        $memberInfo=Member::where('id',$request->id)->select('first_name','member_code','email','member_type','registration_date','user_id')->first();
        if(empty($memberInfo->user_id))
        {
            $exist_email=User::where('email',$memberInfo->email)->count();
            if($exist_email>0)
            {
                return redirect()->back()->with('warning','Email already exist!!');
            }
            $user=User::create([
                'name'=>$memberInfo->first_name,
                'email'=>$memberInfo->email,
                'user_type'=>3,
                'password' => bcrypt($request->input('password')),
                'created_at'=>Carbon::now()
            ]);
            $user->assignRole(2);
            Member::where('id',$request->id)->update(['user_id'=>$user->id]);

            $this->memberInfo->approve($request->id);
            if(isset($email_config->send_application_approval_email) && !empty($email_config->send_application_approval_email) && $email_config->send_application_approval_email==1)
            {
                $memberInfo->send_credentials=1;
                Mail::to($memberInfo->email)->send(new MemberMail($memberInfo));
            }
            return redirect()->back()->with(['message' => "Membership application approved!"]);
        }
        $this->memberInfo->approve($request->id);
        if(isset($email_config->send_application_approval_email) && !empty($email_config->send_application_approval_email) && $email_config->send_application_approval_email==1)
        {
            Mail::to($memberInfo->email)->send(new MemberMail($memberInfo));
        }
        return redirect()->back()->with(['message' => "Membership application approved!"]);
    }

    public function decline(Request $request)
    {
        $this->memberInfo->decline($request->id);
        return redirect()->back()->with(['warning' => "Membership application declined!"]);
    }

    public function search(Request $request)
    {
        if(empty($request->value)) return false;
        $members=Member::where('member_code','LIKE',"%$request->value%")->where('status',1)->select('id','first_name','member_code')->get();
        return json_encode(["members"=>$members]);
    }

    public function previewDoc(Request $request)
    {
        if($request->type=='nid')
        {
            if(File::exists("public/storage/member_nid/".$request->nid))
            {
                return response()->file("public/storage/member_nid/".$request->nid);
            }
        }elseif ($request->type=='hsc')
        {
            if(File::exists("public/storage/member_hsc/".$request->nid)) {
                return response()->file("public/storage/member_hsc/" . $request->nid);
            }
        }elseif ($request->type=='tin')
        {
            if(File::exists("public/storage/member_tin/".$request->nid)) {
                return response()->file("public/storage/member_tin/" . $request->nid);
            }
        }
    }


    public function import()
    {
        $xlsx = SimpleXLSX::parse('storage/members.xlsx');

        $header_values = $rows = [];
        foreach ( $xlsx->rows() as $k => $r ) {
            if ( $k === 0 ) {
                $header_values = $r;
                continue;
            }
            $rows[] = array_combine( $header_values, $r );
        }

        echo "<pre>";print_r( $rows );echo "</pre>";
    }
}
