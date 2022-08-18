<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentPromotionRequest extends FormRequest
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
            // 'grade_id'              => ['required'],
            // 'classroom_id'          => ['required'],
            // 'section_id'            => ['required'],
            // 'new_grade_id'          => ['required'],
            // 'new_classroom_id'      => ['required'],
            // 'new_section_id'        => ['required'],
        ];
    }
}