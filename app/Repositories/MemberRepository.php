<?php
namespace app\Repositories;

use App\Interfaces\MemberInterface;
use App\Mail\MemberMail;
use App\Models\EmailConfig;
use App\Models\Member;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MemberRepository implements MemberInterface
{

    protected $ACTIVE_STATUS=1;

    public function getMember($id){
        $member = DB::table('members')
                ->where('members.id', $id)
                ->where('branch_id',1)
                ->leftJoin('occupations','occupations.id','=','members.occupation')
                ->select('members.*','occupations.occupation')
                ->first();
        $classification=DB::table('member_has_member_classifications')
        ->where('member_id',$id)
        ->join('member_classifications', 'member_classifications.id', '=', 'member_has_member_classifications.member_classifications_id')
        ->select('member_has_member_classifications.member_classifications_id as id','name')
        ->get();


        $member->proposed_member="";
        $member->seconded_member="";
        if(!empty($member->proposed_by))
        {
            $proposed_by = DB::table('members')
                ->where('id', $member->proposed_by)
                ->select('first_name','member_code')
                ->first();
            $member->proposed_member=$proposed_by->first_name ."-".$proposed_by->member_code;
        }
        if(!empty($member->seconded_by)) {
            $seconded_by = DB::table('members')
                ->where('id', $member->seconded_by)
                ->select('first_name', 'member_code')
                ->first();
            $member->seconded_member=$seconded_by->first_name ."-".$seconded_by->member_code;
        }

        if($member->member_type==1)
        {
            $member->member_type="Donor Member";
            $member->member_type_dropdown=1;
        }elseif($member->member_type==2)
        {
            $member->member_type="Life Member";
            $member->member_type_dropdown=2;
        }elseif($member->member_type==3)
        {
            $member->member_type="NRB Member";
            $member->member_type_dropdown=3;
        }elseif($member->member_type==4)
        {
            $member->member_type="General Member";
            $member->member_type_dropdown=4;
        }elseif($member->member_type==5)
        {
            $member->member_type="User Member";
            $member->member_type_dropdown=5;
        }
        elseif($member->member_type==6)
        {
            $member->member_type="Foundation Member";
            $member->member_type_dropdown=6;
        }

        $education = DB::table('member_educations')
            ->where('member_id', $member->id)
            ->get();

        $dependants = DB::table('member_dependant_lists')
            ->where('member_id', $member->id)
            ->get();

        $club_memberships = DB::table('club_memberships')
            ->where('member_id', $member->id)
            ->get();

        if(!empty($classification))
        {
            foreach ($classification as $class)
            {
                $classification_array[$class->id]=$class->id;
            }
        }

        $member->education= $education->isEmpty()?array():$education;
        $member->dependants= $dependants->isEmpty()?array():$dependants;
        $member->club_memberships= $club_memberships->isEmpty()?array():$club_memberships;
        $member->classifications= $classification->isEmpty()?array():$classification;
        return $member;
    }

    public function getProfile($id){
        $member = DB::table('members')
            ->select('members.*','users.email as user_email', 'users.created_at')
            ->leftJoin('users','users.id','=','members.user_id')
            ->where('users.id', $id)
            ->where('branch_id',1)
            ->first();

        $classification=DB::table('member_has_member_classifications')
            ->where('member_id',$member->id)
            ->join('member_classifications', 'member_classifications.id', '=', 'member_has_member_classifications.member_classifications_id')
            ->select('member_has_member_classifications.member_classifications_id as id','name')->get();

        if(!empty($member))
        {
            if($member->member_type==1)
            {
                $member->member_type="Donor Member";
                $member->member_type_dropdown=1;
            }elseif($member->member_type==2)
            {
                $member->member_type="Life Member";
                $member->member_type_dropdown=2;
            }elseif($member->member_type==3)
            {
                $member->member_type="NRB Member";
                $member->member_type_dropdown=3;
            }elseif($member->member_type==4)
            {
                $member->member_type="General Member";
                $member->member_type_dropdown=4;
            }elseif($member->member_type==5)
            {
                $member->member_type="User Member";
                $member->member_type_dropdown=5;
            }
            elseif($member->member_type==6)
            {
                $member->member_type="Foundation Member";
                $member->member_type_dropdown=6;
            }

            $education = DB::table('member_educations')
                ->where('member_id', $member->id)
                ->get();

            $dependants = DB::table('member_dependant_lists')
                ->where('member_id', $member->id)
                ->get();

            $club_memberships = DB::table('club_memberships')
                ->where('member_id', $member->id)
                ->get();

            $member->proposed_member="";
            $member->seconded_member="";
            if(!empty($member->proposed_by))
            {
                $proposed_by = DB::table('members')
                    ->where('id', $member->proposed_by)
                    ->select('first_name','member_code')
                    ->first();
                $member->proposed_member=$proposed_by->first_name ."-".$proposed_by->member_code;
            }
            if(!empty($member->seconded_by)) {
                $seconded_by = DB::table('members')
                    ->where('id', $member->seconded_by)
                    ->select('first_name', 'member_code')
                    ->first();
                $member->seconded_member=$seconded_by->first_name ."-".$seconded_by->member_code;
            }

            $member->education= $education->isEmpty()?array():$education;
            $member->dependants= $dependants->isEmpty()?array():$dependants;
            $member->club_memberships= $club_memberships->isEmpty()?array():$club_memberships;
            $member->classifications= $classification->isEmpty()?array():$classification;
            return $member;
        }else{
            return false;
        }

    }

    public function getMembers(array $data){
        $where=array();
        if(isset($data['request_data']['name']) && !empty($data['request_data']['name']))
        {
            $where[]=['first_name','LIKE','%'.$data['request_data']['name'].'%'];
        }
        if(isset($data['request_data']['email']) && !empty($data['request_data']['email']))
        {
            $where[]=['email',$data['request_data']['email']];
        }
        if(isset($data['request_data']['mobile_number']) && !empty($data['request_data']['mobile_number']))
        {
            $where[]=['mobile_number',$data['request_data']['mobile_number']];
        }
        if(isset($data['request_data']['member_type']) && !empty($data['request_data']['member_type']))
        {
            $where[]=['member_type',$data['request_data']['member_type']];
        }
        if(isset($data['request_data']['blood_group']) && !empty($data['request_data']['blood_group']))
        {
            $where[]=['blood_group',$data['request_data']['blood_group']];
        }
        if(isset($data['request_data']['member_code']) && !empty($data['request_data']['member_code']))
        {
            $where[]=['member_code',$data['request_data']['member_code']];
        }
        $members=DB::table('members')->select("id","first_name","last_name","member_code","registration_date","passing_year","member_type","mobile_number","email","blood_group","privacy_mode")
        ->where('status',$data['status'])
        ->where($where)
        ->orderBy('id','asc')
        ->paginate(25);
        return $members;
    }

    public function addMember(array $data){

        $user=Auth::user();
        if ($user->hasRole('member')) {
            $data['user_id']=$user->id;
        }else
        {
            $data['user_id']=null;
        }

        if(!empty($data['member_photo'])) {
            $image = $data['image'];
            $input['file'] = $data['member_photo'];
            $data['member_photo_file'] = $data['member_code'] . "_" . $input['file'];
            $destinationPath = public_path('/storage/member_photo');
            $imgFile = \Intervention\Image\Facades\Image::make($image->getRealPath());
            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $data['member_photo_file']);
        }else
        {
            $data['member_photo_file']=null;
        }


        if(!empty($data['nid_doc']))
        {
            $nid=$data['nid_doc'];
            $input['file'] =$data['member_nid_doc'];
            $data['member_nid_file']= $data['member_code']."_".$input['file'];
            $nid->move(public_path('/storage/member_nid'),$data['member_nid_file']);
        }else
        {
            $data['member_nid_file']=null;
        }

        if(!empty($data['hsc_doc']))
        {
            $hsc=$data['hsc_doc'];
            $input['file'] =$data['member_hsc_doc'];
            $data['member_hsc_doc']= $data['member_code']."_".$input['file'];
            $hsc->move(public_path('/storage/member_hsc'),$data['member_hsc_doc']);
        }else
        {
            $data['member_hsc_doc']=null;
        }

        if(!empty($data['tin_doc']))
        {
            $tin=$data['tin_doc'];
            $input['file'] =$data['member_tin_doc'];
            $data['member_tin_doc']= $data['member_code']."_".$input['file'];
            $tin->move(public_path('/storage/member_tin'),$data['member_tin_doc']);
        }else
        {
            $data['member_tin_doc']=null;
        }

        if(!empty($data['other_doc']))
        {
            $tin=$data['other_doc'];
            $input['file'] =$data['member_other_doc'];
            $data['member_other_doc']= $data['member_code']."_".$input['file'];
            $tin->move(public_path('/storage/member_other_doc'),$data['member_other_doc']);
        }else
        {
            $data['member_other_doc']=null;
        }

        $member_basic_data=array(
            'registration_date'         =>   $data['registration_date'],
            'passing_year'              =>   $data['passing_year'],
            "first_name"                =>   $data['name'],
            "last_name"                 =>   $data['name'],
            "member_code"               =>   $data['member_code'],
            "member_photo"              =>   $data['member_photo_file'],
            "member_type"               =>   $data['member_type'],
            "blood_group"               =>   $data['blood_group'],
            "college_roll"              =>   $data['college_roll'],
            "date_of_birth"             =>   $data['date_of_birth'],
            "nid"                       =>   $data['nid'],
            "passport"                  =>   $data['passport'],
            "marital_status"            =>   $data['marital_status'],
            "date_of_annniversary"      =>   $data['date_of_annniversary'],
            "no_of_dependants"          =>   $data['no_of_dependants'],
            "fathers_name"              =>   $data['fathers_name'],
            "mothers_name"              =>   $data['mothers_name'],
            "mobile_number"             =>   $data['mobile_number'],
            "email"                     =>   $data['email'],
            "occupation"                =>   $data['occupation'],
            "occupation_type"           =>   $data['occupation_type'],
            "present_address"           =>   $data['present_address'],
            "permanent_address"         =>   $data['permanent_address'],
            "company_name"              =>   $data['company_name'],
            "designation"               =>   $data['designation'],
            "office_address"            =>   $data['office_address'],
            "office_phone"              =>   $data['office_phone'],
            "office_mobile"             =>   $data['office_mobile'],
            "office_email"              =>   $data['office_email'],
            "all_correspondence"        =>   $data['all_correspondence'],
            "should_be_sent_to"         =>   $data['should_be_sent_to'],
            "ever_declined"             =>   $data['ever_declined'],
            "details_of_decline"        =>   $data['details_of_decline'],
            "application_rejected"      =>   $data['application_rejected'],
            "details_of_reject"         =>   $data['details_of_reject'],
            "criminal_ofence"           =>   $data['criminal_ofence'],
            "details_of_criminal_ofence"=>   $data['details_of_criminal_ofence'],
            "car_owned"                 =>   $data['car_owned'],
            "car_reg_no"                =>   $data['car_reg_no'],
            "car_ownership_type"        =>   $data['car_ownership_type'],
            "spouse_name"               =>   $data['spouse_name'],
            "spouse_date_of_birth"      =>   $data['spouse_date_of_birth'],
            "spouse_mobile_number"      =>   $data['spouse_mobile_number'],
            "spouse_email"              =>   $data['spouse_email'],
            "member_nid_file"           =>   $data['member_nid_file'],
            "member_hsc_doc"            =>   $data['member_hsc_doc'],
            "member_tin_doc"            =>   $data['member_tin_doc'],
            "member_other_doc"          =>   $data['member_other_doc'],
            "admission_fee"             =>   $data['admission_fee'],
            "user_id"                   =>   $data['user_id'],
            "proposed_by"               =>   $data['proposed_by'],
            "seconded_by"               =>   $data['seconded_by'],
            "created_at"                =>   Carbon::now(),
            "entry_by"                  =>   $user->id,
        );


        try {
            DB::beginTransaction();
                $id=DB::table('members')->insertGetId($member_basic_data);

                for ($i=0;$i<sizeof($data['institution_name']);$i++)
                {
                    if(isset($data['institution_name'][$i]) && !empty(isset($data['institution_name'][$i]))) {
                        DB::table('member_educations')->insert([
                            'institution_name' => isset($data['institution_name'][$i]) ? $data['institution_name'][$i] : "",
                            'passing_year' => isset($data['edu_passing_year'][$i]) ? $data['edu_passing_year'][$i] : 0,
                            'degree' => isset($data['degree'][$i]) ? $data['degree'][$i] : "",
                            'member_id' => $id
                        ]);
                    }
                }

                for ($i=0;$i<sizeof($data['club_name']);$i++)
                {
                    if(isset($data['club_name'][$i]) && !empty(isset($data['club_name'][$i]))) {
                        DB::table('club_memberships')->insert([
                            'member_id' => $id,
                            'club_name' => isset($data['club_name'][$i]) ? $data['club_name'][$i] : "",
                            'membership_no' => isset($data['membership_no'][$i]) ? $data['membership_no'][$i] : 0,
                            'membership_type' => isset($data['membership_type'][$i]) ? $data['membership_type'][$i] : "",
                        ]);
                    }
                }

                for ($i=0;$i<sizeof($data['dep_name']);$i++)
                {
                    if(isset($data['dep_name'][$i]) && !empty(isset($data['dep_name'][$i]))) {
                        DB::table('member_dependant_lists')->insert([
                            'member_id' => $id,
                            'dep_name' => isset($data['dep_name'][$i]) ? $data['dep_name'][$i] : "",
                            'dep_dob' => isset($data['dep_dob'][$i]) ? $data['dep_dob'][$i] : 0,
                            'dep_blood_group' => isset($data['dep_blood_group'][$i]) ? $data['dep_blood_group'][$i] : "",
                            'dep_occupation' => isset($data['dep_occupation'][$i]) ? $data['dep_occupation'][$i] : "",
                            'dep_nid' => isset($data['dep_nid'][$i]) ? $data['dep_nid'][$i] : "",
                        ]);
                    }
                }

                if(!empty($data['amount']) && $data['amount']>0)
                {
                    $payment_id=Payment::create([
                        "member_id"=>$id,
                        "payment_ref_no"=>$data['payment_ref_no'],
                        "remarks"=>$data['remarks'],
                        "payment_method"=>$data['payment_method'],
                        "payment_type"=>2,
                        "payment_date"=>$data['registration_date'],
                        "purpose_id"=>null,
                        "mr_no"=>null,
                        "created_at"=>Carbon::now(),
                        "created_by"=>Auth::user()->id,
                        "is_payment"=>1
                    ]);

                    PaymentDetails::create([
                        "payment_id"=>$payment_id->id,
                        "member_id"=>$id,
                        "payment_type"=>2,
                        "payment_date"=>$data['registration_date'],
                        "amount"=>$data['amount'],
                        "currency_rate"=>1,
                        "currency"=>"BDT",
                        "payment_month"=>date('m',strtotime($data['registration_date'])),
                        "payment_year"=>date('Y',strtotime($data['registration_date'])),
                        "created_at"=>Carbon::now(),
                        "created_by"=>Auth::user()->id,
                        "is_payment"=>1
                    ]);
                }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message',$e->getMessage());
        }
        return $id;
        // "club_name"=>$data['club_name'],
        // "membership_no"=>$data['membership_no'],
        // "membership_type"=>$data['membership_type'],
        // "dep_name"=>$data['dep_name'],
        // "dep_dob"=>$data['dep_dob'],
        // "dep_blood_group"=>$data['dep_blood_group'],
        // "dep_occupation"=>$data['dep_occupation'],
        // "dep_nid"=>$data['dep_nid'],
        // "branch_name"=>$data['branch_name'],
        // "acc_no"=>$data['acc_no'],
        // DB::table('student_details')->insert($data);
    }

    public function deleteMember($id){
        DB::table('members')->where('id', $id)->delete();
        DB::table('club_memberships')->where('member_id', $id)->delete();
        DB::table('member_dependant_lists')->where('member_id', $id)->delete();
        DB::table('member_educations')->where('member_id', $id)->delete();
        DB::table('payments')->where('member_id', $id)->delete();
        DB::table('payment_details')->where('member_id', $id)->delete();
    }

    public function updateMember(array $data){

    }



    public function updateProfile(array $data){
        if(!empty($data['member_photo']))
        {
            Storage::disk('local')->delete('public/member_photo/'. $data['member_old_photo']);
            $image=$data['image'];
            $input['file'] =$data['member_photo'];
            $data['member_photo_file']= $data['member_code']."_".$input['file'];
            $destinationPath = public_path('/storage/member_photo');
            $imgFile = \Intervention\Image\Facades\Image::make($image->getRealPath());
            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$data['member_photo_file']);
        }else
        {
            $data['member_photo_file']=$data['member_old_photo'];
        }


        if(!empty($data['nid_doc']))
        {
            Storage::disk('local')->delete('public/member_nid/'. $data['member_nid_old_doc']);
            $nid=$data['nid_doc'];
            $input['file'] =$data['member_nid_doc'];
            $data['member_nid_file']= $data['member_code']."_".$input['file'];
            $nid->move(public_path('/storage/member_nid'),$data['member_nid_file']);
        }else
        {
            $data['member_nid_file']=$data['member_nid_old_doc'];
        }

        if(!empty($data['hsc_doc']))
        {
            Storage::disk('local')->delete('public/member_hsc/'. $data['member_hsc_old_doc']);
            $hsc=$data['hsc_doc'];
            $input['file'] =$data['member_hsc_doc'];
            $data['member_hsc_doc']= $data['member_code']."_".$input['file'];
            $hsc->move(public_path('/storage/member_hsc'),$data['member_hsc_doc']);
        }else
        {
            $data['member_hsc_doc']=$data['member_hsc_old_doc'];
        }

        if(!empty($data['tin_doc']))
        {
            Storage::disk('local')->delete('public/member_tin/'. $data['member_tin_old_doc']);
            $tin=$data['tin_doc'];
            $input['file'] =$data['member_tin_doc'];
            $data['member_tin_doc']= $data['member_code']."_".$input['file'];
            $tin->move(public_path('/storage/member_tin'),$data['member_tin_doc']);
        }else
        {
            $data['member_tin_doc']=$data['member_tin_old_doc'];
        }

        if(!empty($data['other_doc']))
        {
            Storage::disk('local')->delete('public/member_other_doc/'. $data['member_other_old_doc']);
            $tin=$data['other_doc'];
            $input['file'] =$data['member_other_doc'];
            $data['member_other_doc']= $data['member_code']."_".$input['file'];
            $tin->move(public_path('/storage/member_other_doc'),$data['member_other_doc']);
        }else
        {
            $data['member_other_doc']=$data['member_other_old_doc'];
        }

        $member_basic_data=array(
            'registration_date'         =>   $data['registration_date'],
            'passing_year'              =>   $data['passing_year'],
            "first_name"                =>   $data['name'],
            "member_code"               =>   $data['member_code'],
            "last_name"                 =>   $data['name'],
            "member_photo"              =>   $data['member_photo_file'],
            // "member_type"               =>   $data['member_type'],
            "blood_group"               =>   $data['blood_group'],
            "college_roll"              =>   $data['college_roll'],
            "date_of_birth"             =>   $data['date_of_birth'],
            "nid"                       =>   $data['nid'],
            "passport"                  =>   $data['passport'],
            "marital_status"            =>   $data['marital_status'],
            "date_of_annniversary"      =>   $data['date_of_annniversary'],
            "no_of_dependants"          =>   $data['no_of_dependants'],
            "fathers_name"              =>   $data['fathers_name'],
            "mothers_name"              =>   $data['mothers_name'],
            "mobile_number"             =>   $data['mobile_number'],
            "email"                     =>   $data['email'],
            "occupation"                =>   $data['occupation'],
            "occupation_type"           =>   $data['occupation_type'],

            "present_address"           =>   $data['present_address'],
            "permanent_address"         =>   $data['permanent_address'],
            "company_name"              =>   $data['company_name'],
            "designation"               =>   $data['designation'],
            "office_address"            =>   $data['office_address'],
            "office_phone"              =>   $data['office_phone'],
            "office_mobile"             =>   $data['office_mobile'],
            "office_email"              =>   $data['office_email'],
            "all_correspondence"        =>   $data['all_correspondence'],
            "should_be_sent_to"         =>   $data['should_be_sent_to'],
            "ever_declined"             =>   $data['ever_declined'],
            "details_of_decline"        =>   $data['details_of_decline'],
            "application_rejected"      =>   $data['application_rejected'],
            "details_of_reject"         =>   $data['details_of_reject'],
            "criminal_ofence"           =>   $data['criminal_ofence'],
            "details_of_criminal_ofence"=>   $data['details_of_criminal_ofence'],
            "car_owned"                 =>   $data['car_owned'],
            "car_reg_no"                =>   $data['car_reg_no'],
            "car_ownership_type"        =>   $data['car_ownership_type'],
            "spouse_name"               =>   $data['spouse_name'],
            "spouse_date_of_birth"      =>   $data['spouse_date_of_birth'],
            "spouse_mobile_number"      =>   $data['spouse_mobile_number'],
            "spouse_email"              =>   $data['spouse_email'],
            "member_nid_file"           =>   $data['member_nid_file'],
            "member_hsc_doc"            =>   $data['member_hsc_doc'],
            "member_tin_doc"            =>   $data['member_tin_doc'],
            "member_other_doc"          =>   $data['member_other_doc'],
            "proposed_by"               =>   $data['proposed_by'],
            "seconded_by"               =>   $data['seconded_by'],
            "updated_at"                =>   Carbon::now(),
            "updated_by"                =>   $data['user_id'],
        );
        DB::table('members')->where('id',$data['member_id'])->update($member_basic_data);
        DB::table('member_educations')->where('member_id',$data['member_id'])->delete();
        if(!empty($data['institution_name']))
        {
            for ($i=0;$i<sizeof($data['institution_name']);$i++)
            {
                if(isset($data['institution_name'][$i]) && !empty(isset($data['institution_name'][$i]))) {
                    DB::table('member_educations')->insert([
                        'institution_name' => isset($data['institution_name'][$i]) ? $data['institution_name'][$i] : "",
                        'passing_year' => isset($data['edu_passing_year'][$i]) ? $data['edu_passing_year'][$i] : 0,
                        'degree' => isset($data['degree'][$i]) ? $data['degree'][$i] : "",
                        'member_id' => $data['member_id']
                    ]);
                }
            }
        }

        DB::table('club_memberships')->where('member_id',$data['member_id'])->delete();
        if(!empty($data['club_name']))
        {
            for ($i=0;$i<sizeof($data['club_name']);$i++)
            {
                if(isset($data['club_name'][$i]) && !empty(isset($data['club_name'][$i]))) {
                    DB::table('club_memberships')->insert([
                        'member_id' => $data['member_id'],
                        'club_name' => isset($data['club_name'][$i]) ? $data['club_name'][$i] : "",
                        'membership_no' => isset($data['membership_no'][$i]) ? $data['membership_no'][$i] : 0,
                        'membership_type' => isset($data['membership_type'][$i]) ? $data['membership_type'][$i] : "",
                    ]);
                }
            }
        }

        DB::table('member_dependant_lists')->where('member_id',$data['member_id'])->delete();

        if(!empty($data['dep_name']))
        {
            for ($i=0;$i<sizeof($data['dep_name']);$i++)
            {
                if(isset($data['dep_name'][$i]) && !empty(isset($data['dep_name'][$i]))) {
                    DB::table('member_dependant_lists')->insert([
                        'member_id' => $data['member_id'],
                        'dep_name' => isset($data['dep_name'][$i]) ? $data['dep_name'][$i] : "",
                        'dep_dob' => isset($data['dep_dob'][$i]) ? $data['dep_dob'][$i] : 0,
                        'dep_blood_group' => isset($data['dep_blood_group'][$i]) ? $data['dep_blood_group'][$i] : "",
                        'dep_occupation' => isset($data['dep_occupation'][$i]) ? $data['dep_occupation'][$i] : "",
                        'dep_nid' => isset($data['dep_nid'][$i]) ? $data['dep_nid'][$i] : "",
                    ]);
                }
            }
        }

        return true;
        // "club_name"=>$data['club_name'],
        // "membership_no"=>$data['membership_no'],
        // "membership_type"=>$data['membership_type'],
        // "dep_name"=>$data['dep_name'],
        // "dep_dob"=>$data['dep_dob'],
        // "dep_blood_group"=>$data['dep_blood_group'],
        // "dep_occupation"=>$data['dep_occupation'],
        // "dep_nid"=>$data['dep_nid'],
        // "branch_name"=>$data['branch_name'],
        // "acc_no"=>$data['acc_no'],
        // DB::table('student_details')->insert($data);

    }



    public function getPostedData(object $request)
    {
        $validated = $request->validated();
        $data['registration_date']      =$validated['registration_date'];
        $data['passing_year']           =$request->member_passing_year;
        $data['name']                   =$validated['name'];
        $data['member_code']            =$validated['member_code'];
        $data['member_type']            =$validated['member_type'];
        $data['blood_group']            =$request->blood_group;
        $data['college_roll']           =$request->college_roll;
        $data['date_of_birth']          =$validated['date_of_birth'];
        $data['nid']                    =$validated['nid'];
        $data['passport']               =$request->passport;
        $data['marital_status']         =$request->marital_status;
        $data['date_of_annniversary']   =$request->date_of_annniversary;
        $data['no_of_dependants']       =$request->no_of_dependants;
        $data['fathers_name']           =$request->fathers_name;
        $data['mothers_name']           =$request->mothers_name;
        $data['mobile_number']          =$validated['mobile_number'];
        $data['email']                  =strtolower($request->email);
        $data["occupation"]             =$request->occupation;
        $data['occupation_type']        =$request->occupation_type;

        $data['admission_fee']          =$request->admission_fee;
        $data['amount']                 =$request->amount;
        $data['payment_method']         =$request->payment_method;
        $data['payment_ref_no']         =$request->payment_ref_no;
        $data['remarks']                =$request->remarks;


        $data['institution_name']       =$request->institution_name;
        $data['degree']                 =$request->degree;
        $data['edu_passing_year']                 =$request->passing_year;
        $data['present_address']        =$validated['present_address'];
        $data['permanent_address']      =$request->permanent_address;
        $data['company_name']           =$request->company_name;
        $data['designation']            =$request->designation;
        $data['office_address']         =$request->office_address;
        $data['office_phone']           =$request->office_phone;
        $data['office_mobile']          =$request->office_mobile;
        $data['office_email']           =$request->office_email;
        $data['all_correspondence']     =$request->all_correspondence;
        $data['should_be_sent_to']      =$request->should_be_sent_to;
        $data['ever_declined']          =$request->ever_declined;
        $data['details_of_decline']     =$request->details_of_decline;
        $data['application_rejected']   =$request->application_rejected;
        $data['details_of_reject']      =$request->details_of_reject;
        $data['criminal_ofence']        =$request->criminal_ofence;
        $data['details_of_criminal_ofence']=$request->details_of_criminal_ofence;
        $data['car_owned']              =$request->car_owned;
        $data['car_reg_no']             =$request->car_reg_no;
        $data['car_ownership_type']     =$request->car_ownership_type;
        $data['club_name']              =$request->club_name;
        $data['membership_no']          =$request->membership_no;
        $data['membership_type']        =$request->membership_type;
        $data['spouse_name']            =$request->spouse_name;
        $data['spouse_date_of_birth']   =$request->spouse_date_of_birth;
        $data['spouse_mobile_number']   =$request->spouse_mobile_number;
        $data['spouse_email']           =$request->spouse_email;
        $data['dep_name']               =$request->dep_name;
        $data['dep_dob']                =$request->dep_dob;
        $data['dep_blood_group']        =$request->dep_blood_group;
        $data['dep_occupation']         =$request->dep_occupation;
        $data['dep_nid']                =$request->dep_nid;
        $data['branch_name']            =$request->branch_name;
        $data['acc_no']                 =$request->acc_no;

        $data["proposed_by"]            =$request->proposed_by;
        $data["seconded_by"]            =$request->seconded_by;

        $image                          =$request->file('member_photo');
        $data['image']                  =$image;
        $data['member_photo']           = !empty($image)?time().'.'.$image->getClientOriginalExtension():null;
        $data['member_old_photo']       =isset($request->member_old_photo)?$request->member_old_photo:null;

        $nid                            =$request->file('nid_doc');
        $data['nid_doc']                =$nid;
        $data['member_nid_doc']         = !empty($nid)?time().'_NID.'.$nid->getClientOriginalExtension():null;
        $data['member_nid_old_doc']     =isset($request->member_nid_old_doc)?$request->member_nid_old_doc:null;

        $hsc                            =$request->file('hsc_doc');
        $data['hsc_doc']                =$hsc;
        $data['member_hsc_doc']         = !empty($hsc)?time().'_HSC.'.$hsc->getClientOriginalExtension():null;
        $data['member_hsc_old_doc']     =isset($request->member_hsc_old_doc)?$request->member_hsc_old_doc:null;

        $tin                            =$request->file('tin_doc');
        $data['tin_doc']                =$tin;
        $data['member_tin_doc']         = !empty($tin)?time().'_TIN.'.$tin->getClientOriginalExtension():null;
        $data['member_tin_old_doc']     =isset($request->member_tin_old_doc)?$request->member_tin_old_doc:null;



        $other_doc                        =$request->file('other_doc');
        $data['other_doc']                =$other_doc;
        $data['member_other_doc']         = !empty($other_doc)?time().'_other_doc.'.$other_doc->getClientOriginalExtension():null;
        $data['member_other_old_doc']     =isset($request->member_other_old_doc)?$request->member_other_old_doc:null;


        $data['user_id']                =isset($request->user_id)?$request->user_id:null;
        $data['member_id']              =isset($request->member_id)?$request->member_id:null;
        return $data;
    }

    public function deleteTable($id,$table)
    {
        DB::table("$table")->where("id",$id)->delete();
        return true;
    }

    public function approve($id)
    {
        $ids=array();
        $application_id_str="";
        if(is_array($id))
        {
            $application_id_str=implode(',',$ids);
            $email_config=EmailConfig::select('send_application_approval_email')->first();
            DB::table('members')->whereIn('id',$id)->update(['status'=>1]);
            foreach ($id as $application_id)
            {
                $memberInfo=Member::where('id',$application_id)->select('first_name','member_code','email','member_type','registration_date','user_id')->first();

                $ids[$application_id]=$application_id;
                $user=User::create([
                    'name'=>$memberInfo->first_name,
                    'email'=>$memberInfo->email,
                    'user_type'=>3,
                    'password' => bcrypt('12345678'),
                    'created_at'=>Carbon::now()
                ]);
                $user->assignRole(2);
                Member::where('id',$application_id)->update(['user_id'=>$user->id]);
                if(isset($email_config->send_application_approval_email) && !empty($email_config->send_application_approval_email) && $email_config->send_application_approval_email==1)
                {
                    $memberInfo->send_credentials=1;
                    Mail::to($memberInfo->email)->send(new MemberMail($memberInfo));
                }
            }
        }else
        {
            DB::table('members')->where('id',$id)->update(['status'=>1]);
        }
    }

    public function decline($id)
    {
        DB::table('members')->where('id',$id)->update(['status'=>0]);
    }
    
}