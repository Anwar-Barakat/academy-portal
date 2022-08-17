<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
            'name_ar'           => ['required', 'min:3'],
            'name_en'           => ['required', 'min:3'],
            'email'             => ['required', 'email', Rule::unique('students')->ignore($this->student->id)],
            'password'          => ['required', 'min:8'],
            'gender'            => ['required', 'in:0,1'],
            'birthday'          => ['required', 'date', 'date_format:Y-m-d'],
            'nationality_id'    => ['required'],
            'blood_id'          => ['required'],
            'grade_id'          => ['required'],
            'classroom_id'      => ['required'],
            'section_id'        => ['required'],
            'parent_id'         => ['required'],
            'academic_year'     => ['required'],
        ];
    }
}