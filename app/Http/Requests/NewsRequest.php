<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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

       $rules= [
            'title_ar'=>'required',
            'title_en'=>'required',
            'body_ar'=>'required',
            'body_en'=>'required'
        ];
        if($id==null)
        {
            $rules= [
                'title_ar'=>'required',
                'title_en'=>'required',
                'body_ar'=>'required',
                'body_en'=>'required',
                'image'=>'required'
            ]; 
        }
        return $rules;
    }
}
