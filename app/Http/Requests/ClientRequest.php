<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
                'name' => 'required',
                'mobile' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'city_id' => 'required',
                'country_id' => 'required',
                'address' => 'required',
                'password' => 'required',
                're_password' => 'required',
            ];
            return $rules;
        }else{
            $rules = [
                'name' => 'required',
                'mobile' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'city_id' => 'required',
                'country_id' => 'required',
                'address' => 'required',
                'password' => 'required',
                're_password' => 'required',
            ];
            return $rules;
        }
    }
}
