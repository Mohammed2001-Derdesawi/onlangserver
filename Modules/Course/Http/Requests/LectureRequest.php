<?php

namespace Modules\Course\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class LectureRequest extends FormRequest
{
    public function rules()
   {
     $rules= [
        'title_ar'=>'required|string|max:255|min:4',
        'title_en'=>'required|string|max:255|min:4',
        'description_ar'=>'required|string|min:4',
        'description_en'=>'required|string|min:4',
        'lecture_link'=>'required|string|min:10',
        'duration'=>'required|numeric|min:0',
        'course'=>['required','integer'],
        'visiable'=>'required|integer|in:0,1',
        'poster'=>'nullable|file|image|mimes:png,jpeg,gif,jpg|max:712',
        'order'=>['required',Rule::unique('lectures','order')->where('course_id',$this->course)],
        'type'=>'required|integer|in:1,0',
    ];

    if(Route::is('admin.lecture.update'))
    {
        $rules['order']=['required',Rule::unique('lectures','order')->where('course_id',$this->course)->where('id','<>',$this->id)];
    }


       return $rules;
   }

    public function messages()
    {
       return [
           'title_ar.required'=>'عنوان المحاضرة مطلوب',
           'title_en.required'=>'عنوان المحاضرة مطلوب',
           'description_ar.required'=>'وصف المحاضرة مطلوب',
           'description_en.required'=>'وصف المحاضرة مطلوب',
           'lecture_link.required'=>'رابط المحاضرة مطلوب',
           'duration.required'=>'مدة المحاضرة مطلوب',
           'course.required'=>'كورس المحاضرة مطلوب',
           'visiable.required'=>'حالة المحاضرة مطلوب',
           'type.required'=>'نوع المحاضرة مطلوب',

           'title_ar.max'=>'عنوان المحاضرة يجب أن يكون أقل من 255 حرف',
           'title_en.max'=>'عنوان المحاضرة يجب أن يكون أقل من 255 حرف',
           'title_ar.min'=>'عنوان المحاضرة يجب أن يكون أكثر من 4 أحرف',
           'title_en.min'=>'عنوان المحاضرة يجب أن يكون أكثر من 4 أحرف',
           'description_ar.min'=>'وصف المحاضرة يجب أن يكون أكثر من 4 أحرف',
           'description_en.min'=>'وصف المحاضرة يجب أن يكون أكثر من 4 أحرف',
           'duration.min'=>'وقت المحاضرة لا يمكن أن يكون صفر',
           'lecture_link.min'=>'رابط المحاضرة مطلوب',

           // string
           'title_ar.string'=>'عنوان المحاضرة يجب أن يكون نص',
           'title_en.string'=>'عنوان المحاضرة يجب أن يكون نص',
           'description_ar.string'=>'وصف المحاضرة يجب أن يكون نص',
           'description_en.string'=>'وصف المحاضرة يجب أن يكون نص',
           'lecture_link.string'=>'رابط المحاضرة يجب أن يكون نص',
           'course.integer'=>'كورس المحاضرة يجب أن يكون رقم',

           'visiable.integer'=>'حالة المحاضرة غير صحيحة',
           'type.integer'=>'نوع المحاضرة غير صحيح',
           'type.in'=>'نوع المحاضرة غير صحيح',
           'duration.numeric'=>'وقت المحاضرة غير صحيح',
           'visiable.in'=>'حالة المحاضرة غير صحيحة',
           'order.required'=>'الترتيب المحاضرة مطلوب',
           'order.unique'=>'الترتيب للمحاضرات موجود',
           'poster.image'=>'يجب ان تكون صورة',
           'poster.mimes'=>'امتدادات الصورة يجب أن تكون احدى التالية png,jpeg,gif,jpg',
           'poster.max'=>'أقصى حجم للصورة هو 712KB'
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
