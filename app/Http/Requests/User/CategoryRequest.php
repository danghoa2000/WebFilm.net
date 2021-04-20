<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        return [
            'name_category' => 'required|max:255',
            'parent_id' => 'nullable'
        ];
    }

    /**
     * display messenger when users enter incorrectly.
     *
     * @return array
     */
    public function messages()
    {
        return[
            'required' => ':attribute không được để trống',
            'max:' => ':attribute không được quá 255 kí tự',
        ];
    }
}
