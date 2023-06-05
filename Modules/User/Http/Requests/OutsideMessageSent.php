<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OutsideMessageSent extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'subject'=>'required|string|min:4',
            'file'=>'required|file|mimes:csv,txt',
            'message'=>'required|string|min:6'
        ];
    }

    public function messages()
    {
        return [
            'subject.required'=>'موضوع الرسالة مطلوب',
            'subject.string'=>'يجب أن يكون موضوع الرسالة عبارة عن نص',
            'subject.min'=>'موضوع الرسالة يجب أن يكون أكثر من 3 أحرف',
            'file.required'=>'الرجاء رفع الملف',
            'file.file'=>'يرجى التأكد من رفع ملف ',
            'file.mimes'=>'يرجى رفع ملف بإمتداد .csv',
            'message.required'=>'الرجاء إدخال رسالة',
            'message.string'=>'يجب أن تكون رسالة عبارة عن نص',
            'message.min'=>'الرسالة يجب أن تكون أكثر من 6 أحرف',
            'message.max'=>'الرسالة يجب أن تكون أقل من 300 حرف',
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
