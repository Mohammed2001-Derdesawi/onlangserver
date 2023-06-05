<?php

namespace Modules\Course\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules= [
            'title_ar'=>'required|max:255|min:4|string',
            'title_en'=>'required|max:255|min:4|string',
            'teachers'=>'nullable|array',
            'description_ar'=>'required|string|min:8',
            'description_en'=>'required|string|min:8',
        ];
        if(!Route::is('admin.article.update')){
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

            // end required messages


            // start string messages
            'title_ar.string'=>'يجب أن يكون العنوان نص',
            'title_en.string'=>'يجب أن يكون العنوان نص',
            'description_ar.string'=>'يجب أن يكون الوصف نص',
            'description_en.string'=>'يجب أن يكون الوصف نص',

            // end string messages




            // differents messages
            'title_ar.max'=>'الرجاء إدخال عنوان أقل من 255 حرف',
            'title_en.max'=>'الرجاء إدخال عنوان أقل من 255 حرف',
            'title_ar.min'=>'الرجاء إدخال عنوان أكثر من 4 أحرف',
            'title_en.min'=>'الرجاء إدخال عنوان أكثر من 4 أحرف',
            'description_ar.min'=>'الرجاء إدخال وصف أكثر من 8 أحرف',
            'description_en.min'=>'الرجاء إدخال وصف أكثر من 8 أحرف',


            'picture.image'=>'يجب ان تكون صورة',
            'picture.mimes'=>'امتدادات الصورة يجب أن تكون احدى التالية png,jpeg,gif,jpg',



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
