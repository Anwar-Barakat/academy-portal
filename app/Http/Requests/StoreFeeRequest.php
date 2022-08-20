<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeRequest extends FormRequest
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
            'amount'        => 'required|digits:3',
            'grade_id'      => 'required',
            'classroom_id'  => 'required',
            'description'   => 'required|min:10',
            'year'          => 'required',
        ];
    }
}