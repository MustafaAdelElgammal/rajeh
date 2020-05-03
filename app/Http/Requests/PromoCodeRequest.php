<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromoCodeRequest extends FormRequest
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
                'code' => "required|unique:promocodes,code",
                'expired_at' => 'required|date',
             'activate_at' => 'required|date',
            ];
        }
        
        $rules = [
             'code' => "required|unique:promocodes,code,$id",
             'expired_at' => 'required|date',
             'activate_at' => 'required|date',
        ];
        
        return $rules;
    }
}
