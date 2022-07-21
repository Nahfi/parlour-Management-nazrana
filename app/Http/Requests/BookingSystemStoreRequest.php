<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingSystemStoreRequest extends FormRequest
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
            'customer_name' => 'required',
            'booking_type' => 'required|in:Staff,Owner',
            'service_name' => 'required',
            'booking_date' => 'required',
            'payment_type' => 'required',
            'total_amount' => 'required',
            'paid' => 'required',
            'due' => 'required',
            'status' => 'required'
        ];
    }
}
