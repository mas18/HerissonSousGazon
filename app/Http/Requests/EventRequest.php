<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class EventRequest extends FormRequest
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
        $start = Carbon::parse($this->dateFrom);
        $maxDiff = $start->addDays(30);

        return [
            'dateFrom'=>'required|date|date_format:Y-m-d|after:yesterday',
            'dateTo'=>'required|date|date_format:Y-m-d|after:dateFrom|before:' . $maxDiff
        ];
    }
}
