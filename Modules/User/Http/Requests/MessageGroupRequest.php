<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageGroupRequest extends FormRequest
{
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'title'=>'required|string|min:3',

        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'حقل العنوان  مطلوب',
            'title.string'=>'حقل العنوان يجب أن يكون نص',
            'title.min'=>'حقل العنوان يجب أن يكون أكثر من 3 حروف',

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
