<?php

namespace App\Http\Requests;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
        $categories = ExpenseCategory::where('status','Active')->get();
        $data = [];
        foreach ($categories as $key=> $category) {
            $data[$key] = $category->id;
        }
        return [
            'category_id' => 'required|in:'. implode(',', $data),
            'name' => 'required',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:Active,DeActive',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'please enter category name',
            'category_id.in' => 'please select from list',
            'amount.rquired' => 'please enter amount',
            'amount.numeric' => 'please enter digits',
            'amount.min' => 'minimum amount must be greater or equeal to 0'
,           'status.required' => 'please select status',
            'status.in' => 'please select from list'
        ];
    }
}
