<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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
        $id = $this->request->get('id');

        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'mobile' => 'required',
            'password' => 'required|confirmed',
        ];

        return $rules;
    }
}
