<?php

namespace Modules\User\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class VariousesSettingsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'price'=>'required|numeric|min:1',
            'preview_video'=>'required|string|min:20',

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
            'price.required'=>'الرجاء إدخال سعر الإشتراك',
            'preview_video.required'=>'الرجاء إدخال رابط فيديو المقدمة',
            'preview_video.string'=>'الرجاء إدخال رابط صحيح ',
            'price.numeric'=>'اللاجاء إدخال قيمة صحيحة',
            'price.min'=>'الرجاء إدخال قيمة أكبر من 0',
            'preview_video.min'=>'الرجاء إدخال رابط صحيح',


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
