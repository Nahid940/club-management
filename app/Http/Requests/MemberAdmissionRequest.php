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
            'name'=>'required',
            'member_type'=>'required',
            'nid'=>'required',
            'present_address'=>'required',
            'date_of_birth'=>'required',
            'mobile_number'=>'required',
            'tc_acceptance'=>'required',
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
