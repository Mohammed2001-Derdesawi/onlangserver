<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
            'description_ar'=>'required|string|min:8',
            'description_en'=>'required|string|min:8',
            'start_at'=>'required|date',
            'end_at'=>'required|date',
            'total_points'=>'required|integer',



        ];
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
            'total_points.required'=>'الرجاء إدخال مجموع النقاط',
            // end required messages


            // start string messages
            'title_ar.string'=>'يجب أن يكون العنوان نص',
            'title_en.string'=>'يجب أن يكون العنوان نص',
            'description_ar.string'=>'يجب أن يكون الوصف نص',
            'description_en.string'=>'يجب أن يكون الوصف نص',
            // end string messages

            // start integer messages
            'total_points.integer'=>'الرجاء إدخال قيمة صحيحة',

            // end integer messages


            // differents messages
            'title_ar.max'=>'الرجاء إدخال عنوان أقل من 255 حرف',
            'title_en.max'=>'الرجاء إدخال عنوان أقل من 255 حرف',
            'title_ar.min'=>'الرجاء إدخال عنوان أكثر من 4 أحرف',
            'title_en.min'=>'الرجاء إدخال عنوان أكثر من 4 أحرف',
            'description_ar.min'=>'الرجاء إدخال وصف أكثر من 8 أحرف',
            'description_en.min'=>'الرجاء إدخال وصف أكثر من 8 أحرف',

            // date messages
            'end_at.date'=>'الرجاء إدخال تاريخ نهاية صحيح',
            'start_at.date'=>'الرجاء إدخال تاريخ بداية صحيح',


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
