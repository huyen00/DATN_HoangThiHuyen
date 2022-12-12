<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
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
            'title' => 'required|unique:languages,key',
            'description_en' => 'nullable',
            'description_vn' => 'nullable',
            'title_en' => 'required',
            'title_vn' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title_en.required' => __('Hãy nhập tên trang Tiếng Anh'),
            'title_vn.required' => __('Hãy nhập tên trang  Tiếng Việt'),
        ];
    }
}
