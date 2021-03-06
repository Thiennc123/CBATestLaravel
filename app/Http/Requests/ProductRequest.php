<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'          => 'required|min:3',
            'file'          => 'max:5',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'         => 'Write name pro',
            'file.max'              => 'Max is 5'
        ];
    }
}
