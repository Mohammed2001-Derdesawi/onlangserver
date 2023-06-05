<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserMessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message'=>'required|string|min:1|max:450'
        ];
    }
    public function messages()
    {
        return [
            'message.required'=>'message input is required',
            'message.string'=>'message should be string ',
            'message.min'=>'message is too short',
            'message.max'=>"message is can't be longer than 450 character",
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
