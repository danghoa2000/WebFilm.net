<?php

namespace App\Http\Requests\Admin;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $year_old = Carbon::now() -> subYears(18);
        return [
            'email' => 'required|email|max:100|unique:users,email,$this->id,id',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'birthday' => 'nullable|before:'.(string)$year_old,
            'avatar' => 'required|image|max:3072',
            'user_name' =>  'required|max:100|unique:users,user_name,'.$this->id,
            'province_id' => 'required',
            'district_id' => 'required',
            'commune_id' => 'required',
            'address' => 'required',
        ];
    }

    /**
     * display messenger when users enter incorrectly.
     *
     * @return array
     */
    public function messages()
    {
        $year_old = Carbon::now() -> subYears(18);
        return [
            'unique' => ':attribute đã tồn tại',
            'required' => ':attribute Không được để trống',
            'max:50' => ':attribute Không được lớn hơn :max kí tự',
            'max:100' => ':attribute Không được lớn hơn :max kí tự',
            'before' => 'người dùng phải trên 18 tuổi',
            'avatar' => 'Ảnh phải thuộc kiểu jpg, jpeg, png',
            'max:3072' => 'Ảnh không được vượt quá :max',
        ];
    }
}
