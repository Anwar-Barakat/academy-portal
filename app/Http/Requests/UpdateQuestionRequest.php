<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
            'title_ar'      => 'required|min:3',
            'title_en'      => 'required|min:3',
            'all_answers'   => 'required|min:3',
            'right_answer'  => 'required|min:3',
            'degrees'       => 'required|numeric',
            'quiz_id'       => 'required',
        ];
    }
}
