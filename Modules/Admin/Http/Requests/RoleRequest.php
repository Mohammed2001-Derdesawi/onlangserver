<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|string|min:3|max:255|unique:roles,name,'.$this->id.',id',
            'premissions'=>'nullable|array',
            'premissions.*'=>'required|integer|exists:permissions,id'

        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'حقل العنوان مطلوب',
            'title.string'=>'حقل العنوان يجب أن يكون نص',
            'title.min'=>'الحد الأدنى للعنوان هو 3 أحرف',
            'title.max'=>'الحد الأعلى للغنوان هو 255 حرف',
            'title.unique'=>'يوجد صلاحية بهذا العنوان',
            'premissions.array'=>'الرجاء التأكد من إدخال قيمة صحيحة',
            'premissions.*.integer'=>'الرجاء التأكد من إدخال قيمة صحيحة',
            'premissions.*.exists'=>'الرجاء التأكد من إدخال قيمة صحيحة',

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
