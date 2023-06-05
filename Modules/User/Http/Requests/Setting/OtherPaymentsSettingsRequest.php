<?php

namespace Modules\User\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OtherPaymentsSettingsRequest extends FormRequest
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
            'image'=>[Rule::requiredIf(function(){
                 if(cache()->get('settings.other_payment_settings')==[])
                 return true;

                 return false;
            }),'image','mimes:png,jpg,gif,jpeg']
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
            'image.image'=>'الرجاء اختيار صورة',
            'image.required'=>'الرجاء اختيار صورة',
            'image.mimes'=>'الرجاء اختيار صورة بإحدى الأمتدادات التالية:png,gif,jpeg,jpg',

        ];
    }
    public function authorize()
    {
        return true;
    }
}
