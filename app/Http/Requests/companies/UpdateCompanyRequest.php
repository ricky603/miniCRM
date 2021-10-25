<?php

namespace App\Http\Requests\companies;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user();
    }

    public function rules()
    {
        return [
            'email' => 'required|unique:companies,email,'. $this->company->id,
            'name' => 'required',
            'website' => 'required'
        ];
    }
}