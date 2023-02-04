<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberAdmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'registration_date'=>'required',
            'name'=>'required|max:28',
            'mothers_name'=>'required|max:28',
            'fathers_name'=>'required|max:28',
            'member_code'=>'nullable|unique:members',
            'member_type'=>'required',
            'college_roll'=>'nullable|unique:members|max:14',
            'nid'=>'required_without:passport|max:15',
            'passport'=>'required_without:nid|max:28',
            'email'=>'required|email',
            'present_address'=>'required|max:120',
            'date_of_birth'=>'required',
            'mobile_number'=>'required|max:14',
            'office_phone'=>'max:14',
            'office_mobile'=>'max:14',
            'office_email'=>'nullable|email|max:30',
            'tc_acceptance'=>'required',
            'spouse_name'=>'required|max:28',
            'spouse_mobile_number'=>'max:14',
            'spouse_email'=>'max:30',
            'car_reg_no'=>'max:28',
            'permanent_address'=>'max:80',
            'company_name'=>'max:50',
            'designation'=>'max:30',
            'details_of_decline'=>'max:120',
            'details_of_reject'=>'max:120',
            'details_of_criminal_ofence'=>'max:120',
            'member_photo' => 'required|image|mimes:jpg,jpeg,png,svg|max:90',
            'nid_doc' => 'mimes:pdf|max:120',
            'hsc_doc' => 'mimes:pdf|max:120',
            'tin_doc' => 'mimes:pdf|max:120',
        ];
    }

    public function messages()
    {
        return [
            'member_type.required' => 'Membership type required!',
            'nid.required' => 'Please give valid NID number!',
            'present_address.required' => 'Please give Present Address!',
            'date_of_birth.required' => 'Valid Date of Birth required!',
            'mobile_number.required' => 'Mobile Number is required!',
            'tc_acceptance.required' => 'Terms & conditions approval required!',
        ];
    }
}
