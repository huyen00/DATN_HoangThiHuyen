<?php

namespace App\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title_en' => 'required',
            'title_vn' => 'required',
            'subtitle_vn' => 'nullable',
            'subtitle_en' => 'nullable',
            'description_en' => 'nullable',
            'description_vn' => 'nullable',
            'link' => 'nullable',
            'video' => 'nullable',
            'images.*' => 'nullable|mimes:png,jpg,jpeg,svg',
            'icon' => 'nullable|mimes:png,svg,webp'
        ];
    }

    public function messages()
    {
        return [
            'title_en.required' => __('Hãy nhập tiêu đề Tiếng Anh'),
            'title_vn.required' => __('Hãy nhập tiêu đề  Tiếng Việt'),
            'title_en.unique' => __('Bài viết  bằng Tiếng Anh đã tồn tại'),
            'title_vn.unique' => __('Bài viết bằng Tiếng Việt đã tồn tại'),
        ];
    }
}
