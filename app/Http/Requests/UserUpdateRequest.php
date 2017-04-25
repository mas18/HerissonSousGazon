<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO IMPLEMENTER LA GESTION DES DROITS
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id=$this->user;
        return [
            //
            'email'=>'required|email|unique:users,email,'.$id,
            'firstname'=>'required|max:50|min:2|',
            'lastname'=>'required|max:50|min:2|',
            'level'=>'numeric|min:0|max:9',
            'street'=>'required|max:25',
            'city'=>'required|max:25',
            'tel'=>'required|min:12|max:13|confirmed',
            'birth'=>'required|date|before:14 years ago'
        ];
    }
}
