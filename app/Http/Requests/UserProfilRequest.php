<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserProfilRequest extends FormRequest
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
       $id= Auth::user()->id;

        return [
            //

            'email'=>'required|email|unique:users,email,'.$id,
            'firstname'=>'required|max:50|min:2|',
            'lastname'=>'required|max:50|min:2|',
            'level'=>'numeric|min:0|max:9',
            'street'=>'required|max:25',
            'city'=>'required|max:25',
            'tel'=>'required|max:13',
            'birth'=>'required|date',
        ];
    }
}
