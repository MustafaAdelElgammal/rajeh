<?php

namespace App\Http\Requests;

//use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
class ProductRequest extends FormRequest
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
//        $this->request->route('id')
        if ($id == null) {
            $rules = [
                'name_ar' => 'required|unique:products,name_ar,',
                'name_en' => 'required|unique:products,name_en,',
            ];

            return $rules;
        }

        $rules = [
            'name_ar' => 'required|unique:products,name_ar,'.$id,
            'name_en' => 'required|unique:products,name_en,'.$id,
        ];

        return $rules;
    }
}
