<?php

namespace App\Http\Requests\companies;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'website' => 'required',
            'photo' => 'nullable|mimes:png,jpg,jpeg|max:2000|dimensions:min_width=100,min_height=100'
        ];
    }
}
