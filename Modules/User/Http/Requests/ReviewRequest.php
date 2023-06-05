<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'review'=>'string|required|max:200|min:2'
            ];
    }
    public function messages()
    {
        return [

            'review.required' => trans('article_trans.required'),
            'review.max'=>trans('article_trans.review_max'),
            'review.min'=>trans('article_trans.review_min'),
            'review.string'=>trans('article_trans.review_str'),



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
