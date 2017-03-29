<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class ScheduleRequest extends FormRequest
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


        $rules = [
            'date'=>'required|date|date_format:Y-m-d',
            'place'=>'required',
            'number'=>'required|min:1|max:20'
        ];

        foreach($this->request->get('timeFrom') as $key => $val)
        {
            $rules['timeFrom.'.$key] = 'required|date_format:H:i';
            $start = 'timeFrom.'.$key;
            $rules['timeTo.'.$key] = 'required|date_format:H:i|after:'. $start;
        }

        return $rules;
    }
}
