<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeRequest extends FormRequest
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
            'name_ar'       => 'required|min:3|regex:/^[\pL\s\-]+$/u|unique:grades,name->ar,' . $this->grade->id,
            'name_en'       => 'required|min:3|regex:/^[\pL\s\-]+$/u|unique:grades,name->en,' . $this->grade->id,
        ];
    }
}