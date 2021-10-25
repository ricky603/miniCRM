<?php

namespace App\Http\Requests\companies\employees;

use Illuminate\Foundation\Http\FormRequest;

class updateEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user();
    }
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable',
            'phone' => 'nullable'
        ];
    }
}