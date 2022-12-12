<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
            'title_en' => 'required|unique:languages,en,' . $this->language_title->id,
            'title_vn' => 'required|unique:languages,vn,' . $this->language_title->id,
            'content_en' => 'required_with:NoiDung',
            'content_vn' => 'required_with:NoiDung',
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
            'title_en.unique' => __('Bài viết  bằng Tiếng Anh đã tồn tại'),
            'title_vn.unique' => __('Bài viết bằng Tiếng Việt đã tồn tại'),
            'content_en.required' => __('Hãy nhập nội dung tin tức Tiếng Anh'),
            'content_vn.required' => __('Hãy nhập nội dung tin tức  Tiếng Việt'),
            'category_id.required' => __('Hãy chọn Thể loại cho tin tức'),
            'outstanding.required' => __('Hãy chọn tin tức có nổi bật hay không?'),
            'image.required' => __('Hãy Thêm ảnh cho tin tức'),
            'tags.required' => __('Hãy chọn tags cho tin tức'),
        ];
    }
}
