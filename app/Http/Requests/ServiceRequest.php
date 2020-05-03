<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
                'name_ar' => "required|unique:services,name_ar",
                'name_en' => 'required|unique:services',
            ];
        }
        
        $rules = [
            'name_ar' => 'required|unique:services,name_ar'.$id,
            'name_en' => 'required|unique:services'.$id,
        ];
        
        return $rules;
//        return [
//            'name_ar'=>'required|unique:services',
//            'name_en'=>'required|unique:services',
//            'cat_id'=>'required',
//        ];
    }
}
