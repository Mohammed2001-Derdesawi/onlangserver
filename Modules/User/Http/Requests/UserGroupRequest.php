<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGroupRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'groups'=>'required|array',
            'groups.*'=>'required|integer|exists:message_groups,id',
            'users'=>'required|array',
            'users.*'=>'required|integer|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'groups.required'=>'الرجاء اختيار المجموعات',
            'groups.array'=>'نوع البيانات غير صحيح',
            'groups.*.integer'=>'نوع البيانات غير صحيح',
            'groups.*.exists'=>'يوجد بيانات لم نجدها يرجى التأكد ثانية',
            'users.required'=>'الرجاء اختيار الطلاب',
            'users.array'=>'نوع البيانات غير صحيح',
            'users.*.integer'=>'نوع البيانات غير صحيح',
            'users.*.exists'=>'يوجد بيانات لم نجدها يرجى التأكد ثانية',
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
