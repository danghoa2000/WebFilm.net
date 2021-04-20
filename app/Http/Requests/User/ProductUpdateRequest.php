<?php

namespace App\Http\Requests\User;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
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
        $time_now = Carbon::now();
        return [
            'name' => 'required|max:255',
            'stock' => 'required|max:10000|min:0|numeric',
            'expired_at' => 'Nullable|after:'.(string)$time_now,
            'avatar' => 'image|max:3072',
            'category_id' => 'required',
            'sku' => 'required|min:10|max:20|regex:/^[a-zA-Z0-9]+$/|unique:products,sku,'.$this->id,
        ];
    }

    /**
     * display messenger when users enter incorrectly.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'after' => ':attribute thời gian hết hạn phải sau hiện tại',
            'unique' => ':attribute đã tồn tại',
            'regex' => ':attribute chỉ chứa A-z a-z 0-9'
        ];
    }
}
