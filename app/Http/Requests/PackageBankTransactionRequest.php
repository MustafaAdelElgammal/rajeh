<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageBankTransactionRequest extends FormRequest
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
        if ($id == null) {
            $rules = [
                'package_id' => 'required',
                'provider_id' => 'required',
                'image' => 'required',
            ];
        }

        $rules = [
            'package_id' => 'required',
            'provider_id' => 'required',
        ];

        return $rules;
    }
}
