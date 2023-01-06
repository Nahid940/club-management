<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
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
            'member_id'=>'required|numeric',
            'date'=>'required',
            'amount'=>'required',
            'payment_method'=>'required',
            'payment_ref_no'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'member_id.required' => 'Select a Member!!',
        ];
    }
}
