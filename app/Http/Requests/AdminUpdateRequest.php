<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
            'role' => 'required',
            'status' => 'required|in:Active,DeActive'
        ];
    }
    public function messages()
    {
        return [
            'role' => 'please select a role',
            'status' => 'please select a status',
            'status.in' => 'please select from list',
        ];
    }
}
