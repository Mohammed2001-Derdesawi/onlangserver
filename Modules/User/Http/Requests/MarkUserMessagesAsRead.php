<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarkUserMessagesAsRead extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user'=>'required|integer|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'user.required'=>'user is required',
            'user.integer'=>'invalid data type',
            'user.exists'=>'user is not found in our records',
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
