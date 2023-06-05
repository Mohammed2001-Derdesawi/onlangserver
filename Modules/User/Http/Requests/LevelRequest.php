<?php

namespace Modules\User\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\User\Entities\Campaign;

class LevelRequest extends FormRequest
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
            'point_price'=>'required|numeric',
            'total_point'=>'required|integer',
            'point_per_one'=>'required|numeric',
            'order'=>['required','integer',Rule::unique('levels','order')->where('campaign_id',$this->campaign)],
            'courses'=>'array|nullable',
            'courses.*'=>'nullable|integer|exists:courses,id',
            "point_price_after_done"=>"nullable|numeric"

        ];
        if(Route::is('admin.level.store'))
        {
            $rules['campaign']='required|integer|exists:campaigns,id';
            $campain=findById(Campaign::class,$this->campaign,[],['id','total_points'],[],["levels as point_levels","total_point"]);
            $sumpoints=$campain->point_levels + $this->total_point;
           if(  $campain->total_points < $sumpoints  || ($this->total_point>$campain->total_points) )
           $rules['total_point']=$rules['total_point']."|max:".$campain->total_points-$campain->point_levels;
        }
        if(Route::is('admin.level.update'))
        $rules['order']=['required','integer',Rule::unique('levels','order')->where('campaign_id',$this->campaign)->where('id','<>',$this->id)];




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
            'total_point.required'=>'الرجاء إدخال مجموع النقاط',
            'point_price.required'=>'الرجاء إدخال  سعر النقطة',
            'point_per_one.required'=>'الرجاء إدخال عدد النقاط للشخص الواحد',
            'order.required'=>'الرجاء إدخال ترتيب المستوى',
            'campaign.required'=>'الرجاء اختيار نظام التربح ',
            // end required messages


            // start string messages
            'title_ar.string'=>'يجب أن يكون العنوان نص',
            'title_en.string'=>'يجب أن يكون العنوان نص',
            'description_ar.string'=>'يجب أن يكون الوصف نص',
            'description_en.string'=>'يجب أن يكون الوصف نص',
            // end string messages

            // start integer messages
            'total_point.integer'=>'الرجاء إدخال قيمة صحيحة',
            'point_price.numeric'=>'الرجاء إدخال قيمة صحيحة',
            'point_per_one.integer'=>'الرجاء إدخال قيمة صحيحة',
            'order.integer'=>'الرجاء إدخال قيمة صحيحة',
            'campaign.integer'=>'الرجاء إدخال قيمة صحيحة',

            // end integer messages


            // differents messages
            'title_ar.max'=>'الرجاء إدخال عنوان أقل من 255 حرف',
            'title_en.max'=>'الرجاء إدخال عنوان أقل من 255 حرف',
            'title_ar.min'=>'الرجاء إدخال عنوان أكثر من 4 أحرف',
            'title_en.min'=>'الرجاء إدخال عنوان أكثر من 4 أحرف',
            'description_ar.min'=>'الرجاء إدخال وصف أكثر من 8 أحرف',
            'description_en.min'=>'الرجاء إدخال وصف أكثر من 8 أحرف',
            'order.unique'=>'ترتيب المستوى موجود بالفعل',
            'campaign.exists'=>'نظام التربح غير موجود',
            'total_point.max'=>'يرجى التأكد بأن مجموع نقاط المستويات أصغر من مجموع النقاط للنظام الذي تم اختياره',

            // date messages
            'end_at.date'=>'الرجاء إدخال تاريخ نهاية صحيح',
            'start_at.date'=>'الرجاء إدخال تاريخ بداية صحيح',

            'courses.array'=>'الرحاء التأكد من إدخال قيم صحيحة',
            'courses.*.integer'=>'الرحاء التأكد من إدخال قيم صحيحة',
            'courses.*.exists'=>'الرحاء التأكد من اختيار دورات موجودة  ',


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
