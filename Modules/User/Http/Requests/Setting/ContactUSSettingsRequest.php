<?php

namespace Modules\User\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class ContactUSSettingsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'phone'=>'required|string|min:1',
            'location'=>'required|string|min:1',
            'email'=>'required|email|string|min:8|max:255',

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function messages()
    {
        return [
            'phone.required'=>'الرجاء إدخال رقم الهاتف',
            'location.string'=>'الرجاء إدخال المكان ',
            'email.min'=>'الرجاء إدخال ايميل صحيح',
            'email.max'=>'الرجاء إدخال ايميل صحيح',
            'email.required'=>'الرجاء إدخال الإيميل',
            'phone.string'=>'الرجاء إدخال رقم هاتف صحيح',
            'phone.min'=>'الرجاء إدخال رقم هاتف صحيح',
            'location.min'=>'الرجاء إدخال مكان صحيح ',
            'location.required'=>'الرجاء إدخال  مكان',
            'email.email'=>'يرجى التأكد من صحة الإيميل',


        ];
    }
    public function authorize()
    {
        return true;
    }
}
