<?php

namespace Modules\Admin\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AdminPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password'=>'required|string|max:255|min:8',
            'new_password'=>'required|string|max:255|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required'=>'الرجاء إدخال كلمة مرور قديمة',
            'new_password.required'=>'الرجاء إدخال كلمة مرور الجديدة',
            'old_password.string'=>'الرجاء كتابة كلمة المرور القديمة',
            'new_password.string'=>'الرجاء كتابة كلمة المرور القديمة',
            'old_password.min'=>'كلمة المرور القديمة غير صحيحة',
            'old_password.max'=>'كلمة المرور القديمة غير صحيحة',
            'new_password.min'=>'كلمة المرور القديمة غير صحيحة',
            'new_password.max'=>'كلمة المرور القديمة غير صحيحة',
            'new_password.confirmed'=>'كلمة المرور الجديدة غير متطابقة',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
