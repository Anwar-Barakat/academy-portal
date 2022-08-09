<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_ar'       => 'required|min:3|unique:grades,name->ar|regex:/^[\pL\s\-]+$/u',
            'name_en'       => 'required|min:3|unique:grades,name->en|regex:/^[\pL\s\-]+$/u',
        ];
    }
}