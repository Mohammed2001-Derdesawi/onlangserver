<?php

namespace Modules\Course\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules= [

            'title_en'=>'required|max:255|min:3|string',
            'title_ar'=>'required|max:255|min:3|string',
        ];

        if(!Route::is('admin.language.update')){
            $rules['picture']='required|image|mimes:png,jpeg,gif,jpg';

        }
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
            'title_en.required'=>'هذا الحقل مطلوب',
            'title_en.max'=>'أقصى عدد للحروف هو 255 حرف',
            'title_en.min'=>'الإسم صغير الرجاء إدخال قيمة أكثر من 3 حروف',
            'title_en.string'=>'الرجاء إدخال قيمة نصية',
            'title_ar.required'=>'هذا الحقل مطلوب',
            'title_ar.max'=>'أقصى عدد للحروف هو 255 حرف',
            'title_ar.min'=>'الإسم صغير الرجاء إدخال قيمة أكثر من 3 حروف',
            'title_ar.string'=>'الرجاء إدخال قيمة نصية',
        ];
    }
}
