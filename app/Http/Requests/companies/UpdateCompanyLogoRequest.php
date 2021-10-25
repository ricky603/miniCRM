<?php

namespace App\Http\Requests\companies;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyLogoRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user();
    }

    public function rules() {
        return [
            'photo' => 'required|max:2000;'
        ];
    }
}