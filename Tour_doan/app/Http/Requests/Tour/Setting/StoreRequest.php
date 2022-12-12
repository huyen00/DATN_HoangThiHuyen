<?php

namespace App\Http\Requests\Tour\Setting;

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
            'thumb' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'logo' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'favicon' => 'nullable|mimes:png|max:2048'
        ];
    }
}
