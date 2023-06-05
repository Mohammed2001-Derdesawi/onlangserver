<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }



    public function rules()
    {
            return [
//                'email'=>'required|max:255|min:8|string|unique:users,email,'.auth()->user()->email.',email',
                'age' => 'required',
                'gender' => 'required',
                'phone' => 'required|max:30',


        ];
    }
    public function messages()
    {
        return [

            'name' => trans('validation.required'),
            'age.required' => trans('validation.required'),
            'phone.required' => trans('validation.required'),

        ];
    }
}
