<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'users'=>'required_if:'.$this->sendToAllusers.',false|array',
            'users.*'=>'required_if:'.$this->sendToAllusers.',false|integer|exists:users,id',
            'message'=>'required|string|min:8',
            'type'=>'required|string|in:email,website,both',
            'subject'=>'required|string|min:3',
            'sender_id'=>'required_if:type,website|integer|exists:admins,id',
            'sender'=>'nullable|email|string|min:7|max:255'

        ];
    }

    public function messages()
    {
        return [
            'users.required'=>'الرجاء التأكد من إختيار طلاب',
            'users.array'=>'الرجاء التأكد من بيانا الطلاب',
            'users.*.exists'=>'الرجاء التأكد من بيانا الطلاب',
            'users.*.required'=>'الرجاء اختيار طلاب',
            'users.integer'=>'الرجاء التأكد من صحة البيانات',
            'message.required'=>'حقل الرسالة مطلوب',
            'message.string'=>'الرسالة يجب ان تكون نص',
            'message.min'=>'يجب أن يكون مضمون الرسالة أكثر من 8 أحرف',
            'subject.required'=>'حقل الموضوع  مطلوب',
            'subject.string'=>'حقل الموضوع يجب أن يكون نص',
            'subject.min'=>'حقل الموضوع يجب أن يكون أكثر من 3 حروف',
            'type.required'=>'يرجى اختيار النوع',
            'type.string'=>'يجب أن يكون النوع نص',
            'type.in'=>'نوع الرسالة غير صحيح',
            'sender_id.required'=>'يرجى إدخال المرسل',
            'sender_id.integer'=>'يرجى إدخال المرسل بطريقة صحيحة',
            'sender_id.exists'=>'المرسل غير موجود',

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