<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            "value"=>"sometimes|required|max:255|regex:/^([A-Z][a-z]{2,})((\s)?[A-z]{2,})*$/",
            "liter"=>"sometimes|required|regex:/^([0-9]+\.?[0-9]*)$/",
            "zip"=>"sometimes|required|regex:/^([\d]{5})+$/|unique:cities,zipCode",
            "role"=>"sometimes|required|exists:roles,id,deleted_at,NULL",
            "date"=>"sometimes|nullable|date"
        ];
    }

    public function messages()
    {
        return [
            'value.required' => 'Value is required.',
            'zip.required' => 'Zip code is required.',
            'zip.regex' => 'Zip code contains 5 numebrs.',
            'zip.unique' => 'Zip code already exist in database',
            'value.regex' => 'Name must start with capital letter.',
            'liter.required' => 'Liter is required.',
            'liter.regex' => 'Liter is decimal value.',
        ];
    }
}
