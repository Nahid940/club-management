<?php

namespace App\Http\Controllers\member;

use App\Http\Requests\MemberProfileUpdateRequest;
use App\Mail\MemberMail;
use App\Mail\BirthdayMail;
use App\Models\EmailConfig;
use App\Models\Member;
use App\Models\MemberClassification;
use App\Models\MembershipType;
use App\Models\Occupation;
use App\Models\User;
use App\Services\DueCalculationService;
use App\Services\MembershipFeeSchedule;
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
use App\Models\Payment;
use App\Models\PaymentDetails;

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

    public function postponedMembers(Request $request)
    {
        $pageTitle="";
        $data['branch_id']=1;
        $data['status']=0; //-1 for new application
        $data['request_data']=$request->all();
        $members=$this->memberInfo->getMembers($data);
        $occupations=Occupation::select('id','occupation')->get();
        return view('pages.member.postponed',['title' => $pageTitle,'members'=>$members,"occupations"=>$occupations]);
    }

    public function revertPostponedMembers(Request $request)
    {
        if(!empty($request->id))
        {
            DB::table('members')->whereIn('id',$request->id)->update(['status'=>1]);
        }
        return redirect()->back()->with('message','Postponed reverted successfully');
    }

    public function biodata($id)
    {
        if(!empty($id))
        {
            $member=DB::table('members')->where('members.id',$id)
                ->leftJoin('occupations','occupations.id','=','members.occupation')
                ->first();
            $educations=DB::table('member_educations')->where('member_id',$id)->get();
            return view('pages.member.biodata',['title' => "","member"=>$member,"educations"=>$educations]);
        }
    }

    public function dataPrivacy($id)
    {
        DB::statement(DB::raw("UPDATE members SET privacy_mode =(CASE WHEN privacy_mode=0 THEN 1 ELSE 0 END)WHERE id=$id"));
        return redirect()->back()->with('message','Privacy mode changed!!');
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
            return view('pages.member.new_application_form',['title' => "",'today'=>$today,"occupations"=>$occupations,'membership_types'=>$membership_types]);
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
        if($request->postponed==1)
        {
            Member::where('id',$request->member_id)->update(['status'=>0]);
            $message="Member postponed successful!!";
            return redirect()->route('member-index')->with(['message' => $message]);
        }
       $id=$request->member_id;
       $member=DB::table('members')->where('id',$id)->first();;
       $this->memberInfo->deleteMember($id);
       if(!empty($member->user_id))
       {
            DB::table('users')->where('id',$member->user_id)->where('email',$member->email)->delete();
            DB::table('model_has_roles')->where('model_id',$member->user_id)->delete();
       }
       $message="Member moved to trash!!";
       if(isset($request->new_application))
       {
            return redirect()->route('new-applications-index')->with(['message' => $message]);
       }
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
        if(!isset($request->approve_all))
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
            };
        }

        $this->memberInfo->approve($request->id);
        if(isset($email_config->send_application_approval_email) && !empty($email_config->send_application_approval_email) && $email_config->send_application_approval_email==1)
        {
//            Mail::to($memberInfo->email)->send(new MemberMail($memberInfo));
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
        $members=Member::where('first_name','LIKE',"%$request->value%")->orWhere('member_code','LIKE',"%$request->value%")
            ->where('status',1)->select('id','first_name','member_code')->get();
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
        }elseif ($request->type=='other_document')
        {
            if(File::exists("public/storage/member_other_doc/".$request->nid)) {
                return response()->file("public/storage/member_other_doc/" . $request->nid);
            }
        }
    }


    public function fees()
    {
        $fees=DB::table('membership_fees')->select('membership_fees.id','membership_types.type_name','admission_fee','monthly_fee')
        ->join('membership_types','membership_types.id','=','membership_fees.membership_type_id')
        ->where('membership_fees.status',1)
        ->get();
        return view('pages.member.fees',['title'=>'','fees'=>$fees]);
    }

    public function feesAdd()
    {
        $types=MembershipType::select('id','type_name')
        ->where('status',1)->get();
        return view('pages.member.fee-add',['title'=>'','types'=>$types]);
    }

    public function saveFees(Request $request)
    {
        $request->validate([
            'membership_type_id'=>'unique:membership_fees'
        ]);
        DB::table('membership_fees')->insert([
            'admission_fee'=>$request->admission_fee,
            'monthly_fee'=>$request->monthly_fee,
            'membership_type_id'=>$request->membership_type_id,
            'effective_from'=>'2018-01-01',
            'updated_at'=>date('Y-m-d'),
            'status'=>1,
        ]);
        return redirect()->route('membership-fees')->with(['message' => "Data added successfully!"]);
    }

    public function feeEdit($id)
    {
        $fee=DB::table('membership_fees')->select('membership_fees.id','membership_types.type_name',
            'admission_fee','monthly_fee','membership_type_id')
            ->join('membership_types','membership_types.id','=','membership_fees.membership_type_id')
            ->where('membership_fees.id',$id)
            ->first();
        return view('pages.member.fees-update',['title'=>'','fee'=>$fee]);
    }

    public function feesUpdate(Request $request)
    {
        DB::table('membership_fees')->where('id',$request->id)->update([
            'closing_date'=>$request->closing_date,
            'status'=>0
        ]);

        $data=DB::table('membership_fees')->insertGetId([
            'admission_fee'=>$request->admission_fee,
            'monthly_fee'=>$request->monthly_fee,
            'membership_type_id'=>$request->membership_type_id,
            'effective_from'=>date('Y-m-01',strtotime("+1 month",strtotime($request->closing_date))),
            'updated_at'=>date('Y-m-d'),
            'status'=>1,
        ]);
        return redirect()->route('fee-edit',$data)->with(['message' => "Data updated successfully!"]);
    }


    public function import()
    {

        DB::table('payments')->truncate();
        DB::table('payment_details')->truncate();
        DB::table('members')->truncate();

        $xlsx = SimpleXLSX::parse('storage/members.xlsx');

        $header_values = $rows = [];
        foreach ( $xlsx->rows() as $k => $r ) {
            if ( $k === 0 ) {
                $header_values = $r;
                continue;
            }
            $rows[] = array_combine( $header_values, $r );
        }

        foreach ($rows as $key=>$row)
        {
            $member_type=substr($rows[$key]['New ID '],0,2);
            $type_id=0;
            if($member_type=='FM')
            {
                $type_id=6;
            } else if($member_type=='LM')
            {
                $type_id=2;
            }else if($member_type=='GM')
            {
                $type_id=4;
            }else if($member_type=='DM')
            {
                $type_id=1;
            }
            else if($member_type=='UM')
            {
                $type_id=5;
            }else if($member_type=='NM')
            {
                $type_id=3;
            }

            $image_file=null;
            if(File::exists("public/storage/member_photo/".$rows[$key]['New ID '].".jpg")) {
                $image_file= $rows[$key]['New ID '].".jpg";
            }else if(File::exists("public/storage/member_photo/".$rows[$key]['New ID '].".JPG"))
            {
                $image_file= $rows[$key]['New ID '].".JPG";
            }
            else if(File::exists("public/storage/member_photo/".$rows[$key]['New ID '].".jpeg"))
            {
                $image_file= $rows[$key]['New ID '].".jpeg";
            }
            else if(File::exists("public/storage/member_photo/".$rows[$key]['New ID '].".png"))
            {
                $image_file= $rows[$key]['New ID '].".png";
            }

            if(!empty($rows[$key]["Member's Name"]))
            {
                DB::table('members')->insert([
                    "first_name"=>$rows[$key]["Member's Name"],
                    "member_code"=>$rows[$key]['New ID '],
                    "member_type"=>$type_id,
                    "registration_date"=>date('Y-m-d',strtotime($rows[$key]["DOM"])),
                    "email"=>$rows[$key]["Email"],
                    "passing_year"=>empty($rows[$key]["Batch"])?0:$rows[$key]["Batch"],
                    "mobile_number"=>$rows[$key]["Contact Number"],
                    "member_photo"=>$image_file,
                ]);
            }
        }

        $xlsx = SimpleXLSX::parse('storage/monthly_fee.xlsx');

        $header_values = $rows = [];
        foreach ( $xlsx->rows() as $k => $r ) {
            if ( $k === 0 ) {
                $header_values = $r;
                continue;
            }
            $rows[] = array_combine( $header_values, $r );
        }


        $year1=2019;
        $year2=2024;
        $month1=1;
        $month2=12;

        $new_array=array();
        foreach ($rows as $key=>$row)
        {
            
            $code=$rows[$key]['Membership ID '];
            $member_id=DB::table('members')->where('member_code',$code)->select('id')->first();
            if(!empty($member_id->id))
            {
                $new_array[$member_id->id]['total']=0;
                $new_array[$member_id->id]['code']=$code;
                for ($year = $year1; $year <= $year2; $year++) {
                    $start_month = ($year == $year1) ? $month1 : 1;
                    $end_month = ($year == $year2) ? $month2 : 12;
                    for ($month = $start_month; $month <= $end_month; $month++) {
                        $time_val=$year."-".($month<10?"0".$month:$month)."-01 00:00:00";

                        if(!empty($row[$time_val]) && intval($row[$time_val])>0)
                        {
                            $new_array[$member_id->id]['payments'][$year."-".($month<10?"0".$month:$month)."-01"]=$row[$time_val];
                            $new_array[$member_id->id]['total']+=intval($row[$time_val]);
                        }
                    }
                }
            }
        }

        foreach($new_array as $key=>$val)
        {
            if($val['total']>0)
            {
                $id=Payment::create([
                    "member_id"=>$key,
                    "payment_ref_no"=>null,
                    "remarks"=>null,
                    "payment_method"=>2,
                    "payment_type"=>1,
                    "payment_date"=>"2023-05-01",
                    "purpose_id"=>null,
                    "mr_no"=>null,
                    "created_at"=>Carbon::now(),
                    "created_by"=>1,
                    "is_payment"=>1,
                    "status"=>1
                ]);

                foreach($val['payments'] as $key_date=>$v)
                {
                    PaymentDetails::create([
                        "payment_id"=>$id->id,
                        "member_id"=>$key,
                        "payment_type"=>1,
                        "payment_date"=>$key_date,
                        "amount"=>$v,
                        "currency_rate"=>1,
                        "currency"=>"BDT",
                        "payment_month"=>date('m',strtotime($key_date)),
                        "payment_year"=>date('Y',strtotime($key_date)),
                        "created_at"=>$v,
                        "created_by"=>1,
                        "is_payment"=>1,
                        "status"=>1
                    ]);
                }
            }
        }


        $xlsx = SimpleXLSX::parse('storage/member_admission_fee.xlsx');

        $header_values = $rows = [];
        foreach ( $xlsx->rows() as $k => $r ) {
            if ( $k === 0 ) {
                $header_values = $r;
                continue;
            }
            $rows[] = array_combine( $header_values, $r );
        }

        $new_array=array();
        foreach ($rows as $key=>$row)
        {
            $code=$row['Membership ID'];
            if(!empty($row['Membership ID']))
            {
                $member_id=DB::table('members')->where('member_code',$code)->select('id')->first();
                if(!empty( $member_id->id))
                {
                    if(!empty($row['Total']))
                    {
                        // echo $member_id->id."<br>";
                        $id=Payment::create([
                            "member_id"=>$member_id->id,
                            "payment_ref_no"=>null,
                            "remarks"=>null,
                            "payment_method"=>2,
                            "payment_type"=>2,
                            "payment_date"=>"2023-05-01",
                            "purpose_id"=>null,
                            "mr_no"=>null,
                            "created_at"=>Carbon::now(),
                            "created_by"=>1,
                            "is_payment"=>1,
                            "status"=>1
                        ]);

                        DB::table('members')->where('id',$member_id->id)->update(['admission_fee'=>$row['Total']]);


                        for ($x = 1; $x <= 13; $x++) {

                            $amount=$row[$x."Installment"];
                            if(!empty($row[$x."Installment"]) && $amount>0)
                            {
                                PaymentDetails::create([
                                    "payment_id"=>$id->id,
                                    "member_id"=>$member_id->id,
                                    "payment_type"=>2,
                                    "payment_date"=>"2023-01-01",
                                    "amount"=>$row[$x."Installment"],
                                    "currency_rate"=>1,
                                    "currency"=>"BDT",
                                    "payment_month"=>5,
                                    "payment_year"=>2023,
                                    "created_at"=>Carbon::now(),
                                    "created_by"=>1,
                                    "is_payment"=>1,
                                    "status"=>1
                                ]);
                            }
                            
                        }
        
                    }
                }
            }
        }

        DB::table('members')->update(['status'=>1]);
        DB::table('payments')->update(['status'=>1]);
        DB::table('payment_details')->update(['status'=>1]);
  
        // echo "<pre>";print_r($rows);die;

    }




    public function birthdayMail()
    {
        $date=date('d');
        $month=date('m');
        $memberInfo=Member::whereMonth('date_of_birth', $month)
        ->whereDay('date_of_birth', $date)
        ->select('first_name','member_code','email','member_type','registration_date','user_id')->get();
        if(count($memberInfo)>0)
        {
            foreach($memberInfo as $info)
            {
                if(isset($info->email) && !empty($info->email))
                {
                    Mail::to($info->email)->send(new BirthdayMail());
                }
            }
        }
        
        
    }


    public function schedule($id,MembershipFeeSchedule $fees_schedule,DueCalculationService $due_calculation)
    {

        date_default_timezone_set('Asia/Dhaka');
        $current_date=date('Y-m-d');
        $current_year=date('Y');
        $current_month=date('m');
        $current_day=date('d');

        if($current_day>=1 && $current_day<=25)
        {
            $current_date=date('Y-m-t',strtotime('-1 month',strtotime($current_date)));
            $current_month=date('m',strtotime($current_date));
        }

        $request=new \stdClass();
        $request->member_id=$id;
        $request->date_to=$current_date;
        $request->to_year=$current_year;
        $request->to_month=intval($current_month);
        $schedule=$due_calculation->getMembersPaymentSchedule($request,$fees_schedule);
        return view('pages.member.schedule',['title'=>'','report_data'=>$schedule]);
    }

    public function searchMemberApi($key)
    {
        $members=Member::where('first_name','LIKE','%'.$key.'%')->orWhere('member_code','LIKE','%'.$key.'%')
        ->select('id','first_name','member_code','mobile_number')
        ->get();
        return response()->json($members,200);
    }

    public function typeChange()
    {
        $types=MembershipType::select('id','type_name')
        ->where('status',1)->get();
        return view('pages.member.member-type-update',['types'=>$types]);
    }

    public function searchMemberTypeupdate(Request $request)
    {
        if(empty($request->value)) return false;
        $members=Member::where('first_name','LIKE',"%$request->value%")->orWhere('member_code','LIKE',"%$request->value%")
            ->join('membership_types','membership_types.id','=','members.member_type')
            ->where('members.status',1)->select('members.id','member_type','first_name','member_code','membership_types.type_name')->get();
        return json_encode(["members"=>$members]);
    }

    public function memberTypeUdate(Request $request)
    {
        $user=Auth::user()->id;
        DB::table('members')->where('id',$request->member_id)->update(['member_type'=>$request->new_type_id]);
        DB::table('member_type_changes')->where('member_id',$request->member_id)->update(['status'=>0]);
        DB::table('member_type_changes')->insert([
            'current_type_id'=>$request->present_type_id,
            'new_type_id'=>$request->new_type_id,
            'member_id'=>$request->member_id,
            'updated_at'=>Carbon::now(),
            'updated_by'=>$user,
            'created_by'=>$user,
            'created_at'=>Carbon::now(),
            'status'=>1,
        ]);
        return redirect()->back()->with('message','Data updated successfully!');
    }
}

