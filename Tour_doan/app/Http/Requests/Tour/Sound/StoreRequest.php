<?php

namespace App\Http\Requests\Tour\Sound;

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
            'sounds.*' =>  'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
        ];
    }
}
