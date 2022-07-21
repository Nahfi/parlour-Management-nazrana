<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
            'identificationNumber'=>'required|unique:employees,identificationNumber',
            'address'=>'required',
            'email' => 'required|unique:employees,email',
            'password' => 'required|confirmed|min:5',
            'status' => 'required|in:Active,DeActive',
            'phone'=>'required|numeric',
            'image'=>'mimes:jpg,jpeg,png',
            'joinDate'=>'required|date',
            'salary'=>'required|numeric|min:0'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'please enter employee name',
            'identificationNumber.unique' => 'this nid/birth-certificate number already registered, please enter a valid number',
            'address.required' => 'please enter employee address',
            'joinDate.required' => 'please select a date',
            'phone.required' => 'please enter a phone number',
            'joinDate.date' => 'please select a date',
            'status.required' => 'please select status',
            'status.in' => 'please select form list',
            'image.mimes' => 'photo format must be jpeg, jpg or png',
            'phone.numeric' => 'please enter number',
            'salary.numeric' => 'please enter number',
            'salary.min' => 'salary must be greater than 0 , please enter a valid salary',

        ];
    }
}