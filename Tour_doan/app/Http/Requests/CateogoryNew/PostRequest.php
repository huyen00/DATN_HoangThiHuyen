<?php

namespace App\Http\Requests\CateogoryNew;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'name' => 'required|unique:category_news,name|min:3|max:100'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên Thể Loại!',
            'name.unique' => 'Tên Thể Loại đã tồn tại, vui lòng nhập lại!',
            'name.min' => 'Tên Thể Loại gồm ít nhất 3 ký tự!',
            'name.max' => 'Tên Thể Loại gồm tối đa 100 ký tự!'
        ];
        
    }
}
