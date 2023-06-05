<?php

namespace Modules\Course\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class OpinionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules=[
            'opinion_en'=>'required|max:255|min:3|string',
            'opinion_ar'=>'required|max:255|min:3|string',
        ];
        if(!Route::is('admin.opinion.update'))
        $rules['image']='required|image|mimes:png,jpg,gif,jpeg';

        return $rules;
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

    public function messages()
    {
        return [
            'opinion_en.required'=>'هذا الحقل مطلوب',
            'opinion_en.max'=>'أقصى عدد للحروف هو 255 حرف',
            'opinion_en.min'=>'الإسم صغير الرجاء إدخال قيمة أكثر من 3 حروف',
            'opinion_en.string'=>'الرجاء إدخال قيمة نصية',
            'opinion_ar.required'=>'هذا الحقل مطلوب',
            'opinion_ar.max'=>'أقصى عدد للحروف هو 255 حرف',
            'opinion_ar.min'=>'الإسم صغير الرجاء إدخال قيمة أكثر من 3 حروف',
            'opinion_ar.string'=>'الرجاء إدخال قيمة نصية',
            'image.required'=>'صورة الرأي مطلوبة',
            'image.image'=>'يجب ان تكون صورة',
            'image.mimes'=>'امتدادات الصورة يجب أن تكون احدى التالية png,jpeg,gif,jpg',

        ];
    }
}
