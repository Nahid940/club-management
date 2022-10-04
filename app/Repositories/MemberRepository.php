<?php
namespace app\Repositories;

use App\Interfaces\MemberInterface;
use PhpParser\Node\Expr\Cast\Object_;

class MemberRepository implements MemberInterface
{

    public function getMember(int $id){
        echo $id;
    }

    public function getMembers(array $data){

    }

    public function addMember(array $data){

    }

    public function deleteMember(int $id){

    }

    public function updateMember(array $data){

    }

    public function getPostedData(object $request)
    {
        $validated = $request->validated();
        $data['registration_date']=$validated['registration_date'];
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
        $data['ever_declined']=$request->ever_declined;
        $data['details_of_decline']=$request->details_of_decline;
        $data['application_rejected']=$request->application_rejected;
        $data['details_of_reject']=$request->details_of_reject;
        $data['criminal_ofence']=$request->criminal_ofence;
        $data['details_of_criminal_ofence']=$request->details_of_criminal_ofence;
        $data['car_owned']=$request->car_owned;
        $data['car_reg_no']=$request->car_reg_no;
        $data['car_ownership_type']=$request->car_ownership_type;
        $data['club_name']=$request->club_name;
        $data['membership_no']=$request->membership_no;
        $data['membership_type']=$request->membership_type;
        $data['spouse_name']=$request->spouse_name;
        $data['spouse_date_of_birth']=$request->spouse_date_of_birth;
        $data['spouse_mobile_number']=$request->spouse_mobile_number;
        $data['spouse_email']=$request->spouse_email;
        $data['dep_name']=$request->dep_name;
        $data['dep_dob']=$request->dep_dob;
        $data['dep_blood_group']=$request->dep_blood_group;
        $data['dep_occupation']=$request->dep_occupation;
        $data['dep_nid']=$request->dep_nid;
        $data['branch_name']=$request->branch_name;
        $data['acc_no']=$request->acc_no;
        return $data;
    }
    
}