<?php

namespace App\Http\Requests;

use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
        $categories = ProductCategory::where('status','Active')->get();
        $brands = ProductBrand::where('status','Active')->get();
        $categoryData = [];
        $brandData = [];
        foreach ($categories as $key=> $category) {
            $categoryData[$key] = $category->id;
        }
        foreach ($brands as $key=> $brand) {
            $brandData[$key] = $brand->id;
        }
        return [
            'image' => 'image|mimes:jpg,jpeg,png',
            'category_id' => 'required|in:'. implode(',', $categoryData),
            'brand_id' => 'in:'. implode(',', $brandData),
            'name' => 'required',
            'status' => 'required|in:Active,DeActive',
            'price' => 'required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'image.image' => 'file must be image',
            'image.mimes' => 'photo format must be jpeg, jpg or png',
            'category_id.required' => 'please select category',
            'category_id.in' => 'please select from list',
            'brand_id.in' => 'please select from list',
            'name.required' => 'please enter product name',
            'status.required' => 'please select status',
            'status.in' => 'please select from list',
            'price.required' => 'please enter price',
            'price.numeric' => 'price must be numeric',
            'price.min' => 'minimum price equal or greater then 0',
        ];
    }
}
