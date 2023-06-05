<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageToAUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'from'=>'required|integer|exists:admins,id',
            'to'=>'required|integer|exists:users,id',
            'message'=>'required|string|min:3',
        ];
    }

    public function messages()
    {
        return[
            'admin.required'=>'invalid Request',
            'admin.integer'=>'invalid Request',
            'admin.exists'=>'invalid Request',
            'user.required'=>'invalid Request',
            'user.integer'=>'invalid Request',
            'user.exists'=>'The User not found!',
            'message.required'=>'The Message is required!',
            'message.string'=>'The Message type is not valid!',
            'message.min'=>'The Message is to short!',

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
