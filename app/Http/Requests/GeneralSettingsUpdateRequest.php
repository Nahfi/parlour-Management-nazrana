<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingsUpdateRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'bin_number' => 'required',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'pelase enter name',
            'phone.required' => 'please enter phone',
            'email.required' => 'please enter email',
            'email.email' => 'please enter valid email',
            'address.required' => 'please enter address',
            'bin_number.required' => 'please enter bin number',
        ];
    }
}
