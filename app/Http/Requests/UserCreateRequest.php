<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO IMPLEMENTER LA GESTION DES DROITS
        return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'firstname'=>'required|max:50|min:2|',
            'email'=>'required|email',
            'lastname'=>'required|email|max:255|',
            'password'=>'required|min:6|confirmed',
            'level'=>'numeric|min:0|max:9',
            'street'=>'required|max:25',
            'city'=>'required|max:25',
            'tel'=>'required|max:20',
        ];
    }
}
