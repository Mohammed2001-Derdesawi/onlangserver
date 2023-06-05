<?php

namespace Modules\Admin\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user=auth()->guard('admin')->user();
        return [

            'name'=>'required|max:255|min:3|string',
            'email'=>['max:255','min:8','string',"unique:admins,email,".$user->email.",email",Rule::requiredIf(function() use($user){
                $user->can('جميع الصلاحيات super_admin');
            })],
            'image'=>'nullable|image|mimes:png,jpg,gif,jpeg',
            'password'=>[Rule::requiredIf(function() use($user){
                $user->can('جميع الصلاحيات super_admin');
            }),'nullable','confirmed','min:7','max:30']
        ];
    }

    public function messages()
    {
           return [
            'name.required'=>'الإسم مطلوب',
            'email.required'=>'الرجاء إدخال البريد الإلكتروني',

            // start string messages
            'name.string'=>'يجب أن يكون الإسم نص',
            'email.string'=>'الرجاء التأكد من كتابة البريد بشكل صحيح',
            'email.email'=>'الرجاء التأكد من كتابة البريد بشكل صحيح',
            'email.unique'=>'البريد الإلكتروني موجود',
            // start min and max messages
            'name.max'=>'يجب أن يكون الإسم أقل من 255 حرف',
            'email.max'=>'يجب أن يكون البريد أقل من 255 حرف',
            'name.min'=>'يجب أن يكون الإسم أكثر من 4 أحرف',
            'email.min'=>'يجب أن يكون البريد أكثر من 4 أحرف',
            'image.image'=>'يجب ان تكون صورة',
            'image.mimes'=>'امتدادات الصورة يجب أن تكون احدى التالية png,jpeg,gif,jpg',
            'password.required'=>'كلمة المرور مطلوبة',
            'password.confirmed'=>'كلمة المرور غير متطابقة',
            'password.string'=>'كلمة المرور يجب ان تكون نص',
            'password.min'=>'كلمة المرور قصيرة',
            'password.max'=>'الحد الأقصى لكلمة المرور هو 30 حرف ',
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
