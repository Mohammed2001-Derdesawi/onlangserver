<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class otherPaymentRequest extends FormRequest
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

            'name' => 'required|min:8|max:60',
            'price' => 'required|numeric|min:10|max:1000',

        ];
    }
    public function messages()
    {
        return [

            'name' => trans('validation.required'),
            'name.max' => trans('validation.max.string'),
            'name.min' => trans('validation.min.numeric'),

            'price.required' => trans('validation.required'),
            'price.max' => trans('validation.max.numeric'),
            'price.min' => trans('validation.min.numeric'),

        ];
    }
}
