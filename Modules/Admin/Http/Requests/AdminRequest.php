<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'email'=>'required|email|max:255|min:8|unique:admins,email,'.$this->id.',id',
            'password'=>'required|confirmed|max:22|min:7',
            'roles'=>'nullable|array',
            'roles.*'=>'nullable|integer|exists:roles,id',
            'image'=>'nullable|image|mimes:png,jpg,jpeg,gif',
        ];
        if(Route::is('admin.admins.update')){
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
            'password.confirmed'=>'كلمة المرور غير متطابقة',
            'email.string'=>'الرجاء التأكد من كتابة البريد بشكل صحيح',
            'email.email'=>'الرجاء التأكد من كتابة البريد بشكل صحيح',
            // start min and max messages
            'name.max'=>'يجب أن يكون الإسم أقل من 255 حرف',
            'password.max'=>'يجب أن تكون كلمة المرور أقل من 22 حرف',
            'email.max'=>'يجب أن يكون البريد أقل من 255 حرف',
            'name.min'=>'يجب أن يكون الإسم أكثر من 4 أحرف',
            'email.min'=>'يجب أن يكون البريد أكثر من 7 أحرف',
            'password.min'=>'يجب أن تكون كلمة المرور أكثر من 7 أحرف',

            'image.image'=>'يجب ان تكون صورة',
            'image.mimes'=>'امتدادات الصورة يجب أن تكون احدى التالية png,jpeg,gif,jpg',
            'roles.array'=>'الرجاء التأكد من إدخال قيمة صحيحة',
            'roles.*.integer'=>'الرجاء التأكد من إدخال قيمة صحيحة',
            'roles.*.exists'=>'الرجاء التأكد من إدخال قيمة صحيحة',

            'email.unique'=>'هذا البريد موجود بالفعل'
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
