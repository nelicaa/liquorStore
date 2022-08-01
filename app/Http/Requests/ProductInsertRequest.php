<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductInsertRequest extends FormRequest
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
            "name"=>"required|max:255|regex:/^([A-Z][a-z]{2,})((\s)?[A-z]{2,})*$/",
            "desc"=>"required|regex:/^([A-Z][a-z])((\s)?[A-z])*$/",
        "category_id"=>"required|numeric|regex:/^[\d]{1,}$/|exists:categories,id,deleted_at,NULL",
            "objPriceLiter.price"=>"numeric|regex:/^[\d]{1,}$/",
            "objPriceLiter.discount"=>"numeric|regex:/^[\d]{1,}$/",
            "idLiter"=>"exists:liter,id,deleted_at,NULL"
        ];
    }
}
