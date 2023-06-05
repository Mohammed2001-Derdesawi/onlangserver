<?php

namespace Modules\User\Http\Requests\Setting;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AboutUSSettingsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description_ar'=>'required|string|min:1',
            'description_en'=>'required|string|min:1',
            'description_ar_seconed'=>'required|string|min:1',
            'description_en_seconed'=>'required|string|min:1',
            'image'=>[Rule::requiredIf(function(){
                 if(cache()->get('settings.aboutus')==[])
                 return true;

                 return false;
            }),'image','mimes:png,jpg,gif,jpeg'],
            'feachers'=>'array|required',
            'feachers.*.*'=>'string|required|min:3'
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
            'description_ar.required'=>'الرجاء إدخال وصف',
            'description_ar.string'=>'الرجاء إدخال وصف صحيح',
            'description_ar.min'=>'الرجاء إدخال وصف',
            'description_en.required'=>'الرجاء إدخال وصف',
            'description_en.string'=>'الرجاء إدخال وصف صحيح',
            'description_en.min'=>'الرجاء إدخال وصف',
            'description_ar_seconed.required'=>'الرجاء إدخال وصف',
            'description_ar_seconed.string'=>'الرجاء إدخال وصف صحيح',
            'description_ar_seconed.min'=>'الرجاء إدخال وصف',
            'description_en_seconed.required'=>'الرجاء إدخال وصف',
            'description_en_seconed.string'=>'الرجاء إدخال وصف صحيح',
            'description_en_seconed.min'=>'الرجاء إدخال وصف',
            'image.image'=>'الرجاء اختيار صورة',
            'image.required'=>'الرجاء اختيار صورة',
            'image.mimes'=>'الرجاء اختيار صورة بإحدى الأمتدادات التالية:png,gif,jpeg,jpg',
            'feachers.array'=>'الرجاء التأكد من إدخال قيم صحيحة',
            'feachers.required'=>'المميزات مطلوبة',
            'feachers.*.*.string'=>'الرجاء التأكد من القيم المدخلة',
            'feachers.*.*.required'=>'الرجاء إدخال جميع القيم ',
            'feachers.*.*.min'=>'يجب أن تكون الميزة أكثر من ثلاثة أحرف',

        ];
    }
    public function authorize()
    {
        return true;
    }
}
