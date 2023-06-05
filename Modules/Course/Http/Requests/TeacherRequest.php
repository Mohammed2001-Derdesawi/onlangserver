<?php

namespace Modules\Course\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
  /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules=[
            'name_ar'=>'required|string|min:4|max:255',
            'name_en'=>'required|string|min:4|max:255',
            'email'=>'required|email|max:255|min:8|string|unique:teachers,email,'.$this->id.',id',
            'description_ar'=>'required|string|min:8',
            'description_en'=>'required|string|min:8',
            'courses'=>'nullable|array',
            'courses.*'=>'nullable|integer|exists:courses,id',
            'preview_video'=>'required|string|min:10',
            "has_private_learning"=>'required|integer|in:0,1',
            "private_video"=>'nullable|string|min:10'
        ];
        if(!Route::is('admin.teacher.update'))
        $rules['image']='required|image|mimes:png,jpg,gif,jpeg';



        return $rules;
    }

    public function messages()
    {
        return [
            // start required messages
            'name_ar.required'=>'الرجاء إدخال اسم المعلم',
            'name_en.required'=>'الرجاء إدخال اسم المعلم',
            'email.required'=>'الرجاء إدخال البريد الإلكتروني',
            'description_ar.required'=>'الرجاء إدخال الوصف',
            'description_en.required'=>'الرجاء إدخال الوصف',
            'image.required'=>'صورة المعلم مطلوبة',
            'preview_video.required'=>'فيديو المقدمة مطلوب',

            // start string messages
            'name_ar.string'=>'يجب أن يكون الإسم نص',
            'name_en.string'=>'يجب أن يكون الإسم نص',
            'preview_video.string'=>'يجب أن يكون الرابط نص',
            'description_ar.string'=>'يجب أن يكون الوصف نص',
            'description_en.string'=>'يجب أن يكون الوصف نص',
            'email.string'=>'الرجاء التأكد من كتابة البريد بشكل صحيح',
            'email.email'=>'الرجاء التأكد من كتابة البريد بشكل صحيح',
            // start min and max messages
            'name_ar.max'=>'يجب أن يكون الإسم أقل من 255 حرف',
            'name_en.max'=>'يجب أن يكون الإسم أقل من 255 حرف',
            'email.max'=>'يجب أن يكون البريد أقل من 255 حرف',
            'name_ar.min'=>'يجب أن يكون الإسم أكثر من 4 أحرف',
            'name_en.min'=>'يجب أن يكون الإسم أكثر من 4 أحرف',
            'email.min'=>'يجب أن يكون البريد أكثر من 4 أحرف',
            'description_ar.min'=>'يجب أن يكون الوصف أكثر من 8 أحرف',
            'description_en.min'=>'يجب أن يكون الوصف أكثر من 8 أحرف',
            'preview_video.min'=>'يجب أن يكون الرابط أكثر من 10 أحرف',

            'image.image'=>'يجب ان تكون صورة',
            'image.mimes'=>'امتدادات الصورة يجب أن تكون احدى التالية png,jpeg,gif,jpg',
            'courses.array'=>'الرجاء التأكد من إدخال قيمة صحيحة',
            'courses.*.integer'=>'الرجاء التأكد من إدخال قيمة صحيحة',
            'courses.*.exists'=>'الرجاء التأكد من إدخال قيمة صحيحة',
            'email.unique'=>'البريد الإلكتروني موجود بالفعل',
            'preview_video.url'=>'يرجى التأكد من الرابط المدخل',


        ];
    }
    public function authorize()
    {
        return true;
    }
}
