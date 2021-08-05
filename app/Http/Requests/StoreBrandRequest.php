<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
    public function rules()
    {
        return [
            'brand_name' => 'required|unique:brands|max:20',
            'brand_image' => 'required|mimes:jpg,jpeg,png'
        ];
    }


    public function messages()
    {
        return [
            'brand_name.required' => '*Please input Brand Name',
            'brand_name.max' => '*Brand Name Should Be Less Than 20 Characters',
            'brand_image.required' => '*Please Upload Brand image',
        ];
    }
}
