<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuizRequest extends FormRequest
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
            'name_ar'           => 'required|min:3',
            'name_en'           => 'required|min:3',
            'grade_id'          => 'required',
            'classroom_id'      => 'required',
            'section_id'        => 'required',
            'teacher_id'        => 'required',
            'subject_id'        => 'required',
        ];
    }
}