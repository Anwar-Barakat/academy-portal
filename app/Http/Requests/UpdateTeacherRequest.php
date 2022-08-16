<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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
            'email'                 => 'required|email|unique:teachers,email,' . $this->id,
            'password'              => 'required|min:3',
            'name_ar'               => 'required|min:3',
            'name_en'               => 'required|min:3',
            'gender'                => 'required|in:0,1',
            'specialization_id'     => 'required',
            'joining'               => 'required|date|date_format:Y-m-d',
            'address'               => 'required|min:10',
        ];
    }
}