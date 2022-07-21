<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'name'=>'required',
            'status' => 'required|in:Active,DeActive',
            'type' => 'required|in:Vip,Normal,Gold,Platinum,Silver',
            'email'=>'email',
            'phone'=>'numeric',
            'image'=>'mimes:jpg,jpeg,png',
            'cardNumber'=>'numeric',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'please enter name',
            'email.email' => 'please enter a valid email address',
            'status.required' => 'please select status',
            'status.in' => 'please select form list',
            'type.required' => 'please select status',
            'type.in' => 'please select form list',
            'image.mimes' => 'photo format must be jpeg, jpg or png',
            'cardNumber.numeric' => 'please enter number',
            'phone.numeric' => 'please enter number',

        ];
    }
}
