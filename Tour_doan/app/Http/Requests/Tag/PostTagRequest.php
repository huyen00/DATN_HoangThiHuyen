<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class PostTagRequest extends FormRequest
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
            'name' => 'required|unique:tags,name|min:2|max:100'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên Tag!',
            'name.unique' => 'Tên Tag đã tồn tại, vui lòng nhập lại!',
            'name.min' => 'Tên Tag gồm ít nhất 3 ký tự!',
            'name.max' => 'Tên Tag gồm tối đa 100 ký tự!'
        ];
    }
}
