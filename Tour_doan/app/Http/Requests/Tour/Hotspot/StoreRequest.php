<?php

namespace App\Http\Requests\Tour\Hotspot;

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
            'name' => 'required',
            'category_hotspot_id' => 'nullable',
            'icon_id' => 'nullable',
            'video' => 'nullable',
            'description_vn' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'nullable|mimes:png,jpg',
            'link' => 'nullable',
        ];
    }
    public function messages()
    {
        return [
            'category_hotspot_id.required' => 'You must choose Category Hotspot',
            'icon_id.required' => 'You must choose Icon Hotspot'
        ];
    }
}
