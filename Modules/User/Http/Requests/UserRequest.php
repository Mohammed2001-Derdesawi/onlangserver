<?php

namespace Modules\User\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules= [
            'name'=>'required|string|max:255|min:4',
            'email'=>'required|email|unique:users,email,'.$this->id.',id'.'|max:255|min:8',
            'password'=>'required|confirmed|max:22|min:7',
            'courses'=>'nullable|array',
            'courses.*'=>'nullable|integer|exists:courses,id',
            'image'=>'nullable|image|mimes:png,jpg,jpeg,gif',
            'gender'=>'required|string|in:male,gender',
            'phone'=>'nullable|string|max:11|min:7'
        ];
        if(Route::is('admin.student.update'))
        {
            $rules['password']='nullable|confirmed|max:22|min:7';

        }
        return $rules;
    }

    public function messages()
    {
        return [
            // start required messages
            'name.required'=>'الرجاء إدخال اسم الطالب',
            'password.required'=>'الرجاء إدخال كلمة المرور ',
            'email.required'=>'الرجاء إدخال البريد الإلكتروني',

            // start string messages
            'name.string'=>'يجب أن يكون الإسم نص',
            'password.string'=>'يجب أن تكون كلمة المرور نص',
            'phone.string'=>'الرجاء التأكد من إدخال رقم صحيح',
            'password.confirmed'=>'كلمة المرور غير متطابقة',
            'email.string'=>'الرجاء التأكد من كتابة البريد بشكل صحيح',
            'email.email'=>'الرجاء التأكد من كتابة البريد بشكل صحيح',
            // start min and max messages
            'name.max'=>'يجب أن يكون الإسم أقل من 255 حرف',
            'password.max'=>'يجب أن تكون كلمة المرور أقل من 22 حرف',
            'email.max'=>'يجب أن يكون البريد أقل من 255 حرف',
            'phone.max'=>'يجب أن يكون الجوال أقل من 10 حرف',
            'name.min'=>'يجب أن يكون الإسم أكثر من 4 أحرف',
            'email.min'=>'يجب أن يكون البريد أكثر من 7 أحرف',
            'phone.min'=>'يجب أن يكون رقم الجوال أكثر من 7 أحرف',
            'password.min'=>'يجب أن تكون كلمة المرور أكثر من 7 أحرف',

            'image.image'=>'يجب ان تكون صورة',
            'image.mimes'=>'امتدادات الصورة يجب أن تكون احدى التالية png,jpeg,gif,jpg',
            'courses.array'=>'الرجاء التأكد من إدخال قيمة صحيحة',
            'courses.*.integer'=>'الرجاء التأكد من إدخال قيمة صحيحة',
            'courses.*.exists'=>'الرجاء التأكد من إدخال قيمة صحيحة',

            'email.unique'=>'البريد موجود بالفعل',
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
