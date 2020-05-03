<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'          => 'required|string',
            'email'         => 'required|email|unique:users,email,'.$id ,
            'photo'         => 'sometimes|image|mimes:jpeg,bmp,png,jpg',
        ];
        if($id==null){
            $rules['password']='sometimes|required|confirmed|min:8';
            $rules['password_confirmation']='sometimes|required_with:password|same:password';
        }
        return $rules;

//        return [
//            'name'          => 'required|string',
//            'email'         => 'required|email|unique:users,email,'.$id ,
//            'password'      => 'sometimes|required|confirmed|min:8',
//            'photo'         => 'sometimes|image|mimes:jpeg,bmp,png,jpg',
//        ];
    }
}
