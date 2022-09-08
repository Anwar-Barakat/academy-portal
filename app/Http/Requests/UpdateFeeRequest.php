<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeeRequest extends FormRequest
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
            'type'          => 'required|in:0,1',
            'amount'        => 'required|min:0|numeric',
            'grade_id'      => 'required',
            'classroom_id'  => 'required',
            'description'   => 'required|min:10',
            'year'          => 'required',
        ];
    }
}