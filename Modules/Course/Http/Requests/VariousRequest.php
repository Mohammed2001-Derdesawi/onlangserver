<?php

namespace Modules\Course\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class VariousRequest extends FormRequest
{
    public function rules()
    {
        $rules=[
            'title_ar'=>'required|max:255|min:4|string',
            'title_en'=>'required|max:255|min:4|string',
            'description_ar'=>'required|string|min:8',
            'description_en'=>'required|string|min:8',
            'path'=>'required|string|min:10',
            'type'=>'required|string|in:paid,free',
            'group'=>'nullable|integer|exists:various_groups,id',

        ];

        if(!Route::is('admin.various.update'))
        $rules['image']='required|image|mimes:png,jpg,gif,jpeg';

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
            'image.required'=>'صورة المقدمة مطلوبة',
            'path.required'=>'فيديو المقدمة مطلوب',
            'type.required'=>'النوع مطلوب',


            // end required messages


            // start string messages
            'title_ar.string'=>'يجب أن يكون العنوان نص',
            'title_en.string'=>'يجب أن يكون العنوان نص',
            'description_ar.string'=>'يجب أن يكون الوصف نص',
            'description_en.string'=>'يجب أن يكون الوصف نص',
            'path.string'=>'يجب أن يكون الرابط نص',
            'type.string'=>'يجب أن يكون النوع نص',

            // end string messages







            // differents messages
            'title_ar.max'=>'الرجاء إدخال عنوان أقل من 255 حرف',
            'title_en.max'=>'الرجاء إدخال عنوان أقل من 255 حرف',
            'title_ar.min'=>'الرجاء إدخال عنوان أكثر من 4 أحرف',
            'title_en.min'=>'الرجاء إدخال عنوان أكثر من 4 أحرف',
            'description_ar.min'=>'الرجاء إدخال وصف أكثر من 8 أحرف',
            'description_en.min'=>'الرجاء إدخال وصف أكثر من 8 أحرف',
            'image.image'=>'يجب ان تكون صورة',
            'image.mimes'=>'امتدادات الصورة يجب أن تكون احدى التالية png,jpeg,gif,jpg',
             'type.in'=>'يرجى التأكد من القيمة المدخلة',
            'path.min'=>'يجب أن يكون الرابط أكثر من 10 أحرف',
            'path.url'=>'يرجى التأكد من الرابط المدخل',
            'group.integer'=>'يجب أن يكون عبارة عن رقم',
            'group.exists'=>'يرجى التأكد من القيم المدخلة',



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
