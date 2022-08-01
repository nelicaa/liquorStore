<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInsertRequest extends FormRequest
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
            "first_n"=>"required|max:255|regex:/^([A-Z][a-z]{2,})((\s)?[A-Z][a-z]{2,})*$/",
            "last_n"=>"required|max:255|regex:/^([A-Z][a-z]{2,})((\s)?[A-Z][a-z]{2,})*$/",
            "email"=>"required|max:255|regex:/^[\w\d\.\-]+@[a-z]{2,}(\.[a-z]{2,3})+$/|unique:users,email",
            "phone"=>"required|regex:/^\+([\d]{10,11})+$/",
            "password"=>"required|regex:/^.{5,}$/",
            "picture"=>"required|mimes:jpeg,jpg,png",
            "street"=>"required|regex:/^[\w\s.-]+[\dA-z]+\s*[\w\s.-]+$/",
            "city_id"=>"required|exists:cities,id,deleted_at,NULL"
        ];



    }
}
