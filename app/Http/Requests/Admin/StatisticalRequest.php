<?php

namespace App\Http\Requests\Admin;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StatisticalRequest extends FormRequest
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
        if (isset($this->endDate) || isset($this->startDate)) {
            return [
                'startDate' => 'required|before_or_equal: '.$this->endDate,
                'endDate' => 'required|after_or_equal: '.$this->startDate,
            ];
        }
        return [
            'startDate' => 'nullable',
            'endDate' => 'nullable',
        ];
    }
}
