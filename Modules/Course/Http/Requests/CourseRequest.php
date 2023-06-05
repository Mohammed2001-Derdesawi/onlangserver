<?php

namespace Modules\Course\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Course\Entities\Teacher;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function rules()
    {
        $rules= [
            'title_ar'=>'required|max:255|min:4|string',
            'title_en'=>'required|max:255|min:4|string',
            'teachers'=>'nullable|array',
            'teachers.*'=>['nullable','integer','exists:teachers,id'],
            'description_ar'=>'required|string|min:8',
            'description_en'=>'required|string|min:8',
            'meta_description'=>'nullable|string|min:8',
            'features'=>'nullable|string|min:8',
            'start_at'=>'nullable|string',
            'end_at'=>'nullable|string',
            'price'=>'required|numeric',
            'duration'=>'required|numeric|min:0',
            'visiable'=>'required|integer|in:0,1',
            'preview'=>'required|string|min:8',
            'language_id'=>'nullable|integer|min:1|exists:languages,id',



        ];
        if(!Route::is('admin.course.update')){
            $rules['picture']='required|image|mimes:png,jpeg,gif,jpg';

        }
        return $rules;
    }

    public function messages()
    {

        return [
            // start required messages
            'title_ar.required'=>'الرجاء إدخال عنوان',
            'title_en.required'=>'الرجاء إدخال عنوان',
            'description_ar.required'=>'الرجاء إدخال الوصف',
            'description_en.required'=>'الرجاء إدخال الوصف',
            'picture.required'=>'الرجاء إختيار صورة',
            'price.required'=>'الرجاء إدخال السعر',
            'duration.required'=>'الرجاء إدخال المدة',
            'visiable.required'=>'الرجاء إدخال الحالة',
            'preview.required'=>'الرجاء إدخال رابط الفيديو التقديمي',
            // end required messages


            // start string messages
            'title_ar.string'=>'يجب أن يكون العنوان نص',
            'title_en.string'=>'يجب أن يكون العنوان نص',
            'description_ar.string'=>'يجب أن يكون الوصف نص',
            'description_en.string'=>'يجب أن يكون الوصف نص',
            'meta_description.string'=>'يجب أن يكون الوصف نص',
            'features.string'=>'يجب أن يكون العنوان نص',
            'end_at.string'=>'الرجاء إدخال تاريخ نهاية صحيح',
            'start_at.string'=>'الرجاء إدخال تاريخ بداية صحيح',
            'preview.string'=>'الرجاء إدخال رابط  صحيح',
            // end string messages

            // start integer messages
            'teachers.*.integer'=>'الرجاء إدخال قيم صحيحة',
            'price.numeric'=>'الرجاء إدخال قيمة صحيحة',
            'duration.numeric'=>'الرجاء إدخال قيمة صحيحة',
            'visiable.integer'=>'الرجاء  إدخال قيمة صحيحة',
            'language.integer'=>'الرجاء التأكد من إدخال قيمة صحيحة',
            // end integer messages


            // differents messages
            'title_ar.max'=>'الرجاء إدخال عنوان أقل من 255 حرف',
            'title_en.max'=>'الرجاء إدخال عنوان أقل من 255 حرف',
            'title_ar.min'=>'الرجاء إدخال عنوان أكثر من 4 أحرف',
            'title_en.min'=>'الرجاء إدخال عنوان أكثر من 4 أحرف',
            'language.min'=>'الرجاء إختيار لغة صحيحة',
            'description_ar.min'=>'الرجاء إدخال وصف أكثر من 8 أحرف',
            'description_en.min'=>'الرجاء إدخال وصف أكثر من 8 أحرف',
            'features.min'=>'الرجاء إدخال مميزات أكثر من 8 أحرف',
            'preview.min'=>'الرجاء التأكد من أن رابط فيديو التقديمي  أكثر من 8 أحرف',
            'teachers.*.exists'=>'الرجاء التأكد من إختيار قيم صحيحة',
            'language.exists'=>'الرجاء التأكد من إختيار قيم صحيحة',
            'visiable.in'=>'الرجاء التأكد من إختيار قيم صحيحة',
            'picture.image'=>'يجب ان تكون صورة',
            'picture.mimes'=>'امتدادات الصورة يجب أن تكون احدى التالية png,jpeg,gif,jpg',
            'duration.min'=>'الرجاء إدخال قيمة صحيحة',

        ];
    }
    public function authorize()
    {
        return true;
    }
}
