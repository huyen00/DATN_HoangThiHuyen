<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class PostNewsRequest extends FormRequest
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
            'title_en' => 'required|unique:languages,en',
            'title_vn' => 'required|unique:languages,vn',
            'content_en' => 'required',
            'content_vn' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
            'outstanding' => 'required',
            'tags' => 'required',
            'category_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title_en.required' => __('Hãy nhập tiêu đề Tiếng Anh'),
            'title_vn.required' => __('Hãy nhập tiêu đề  Tiếng Việt'),
            'content_en.required' => __('Hãy nhập nội dung tin tức Tiếng Anh'),
            'content_vn.required' => __('Hãy nhập nội dung tin tức  Tiếng Việt'),
            'category_id.required' => __('Hãy chọn Thể loại cho tin tức'),
            'outstanding.required' => __('Hãy chọn tin tức có nổi bật hay không?'),
            'image.required' => __('Hãy Thêm ảnh cho tin tức'),
            'tags.required' => __('Hãy chọn tags cho tin tức'),
        ];
    }
}
