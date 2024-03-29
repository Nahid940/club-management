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
            'date'=>'required|date',
            'amount'=>'required|numeric|digits_between:2,10',
            'payment_method'=>'required',
            'payment_ref_no'=>'max:25',
        ];
    }

    public function messages()
    {
        return [
            'member_id.required' => 'Select a Member!!',
        ];
    }
}
