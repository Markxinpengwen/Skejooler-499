<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class centerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //TODO
        return [
            'cid' => 'required|unique',
            'name' => 'required|string',
            'email' => 'email',
            'phone' => 'digits_between:10, 10',
            'description' => '',
            'canSupportOnlineExam' => 'boolean',
            'cost' => 'numeric',
            'street_name' => 'string',
            'city' => 'string',
            'province' => 'string',
            'country' => 'string',
            'postal_code' => 'between:7,7',
            'longitude' => '',
            'latitude' => ''
        ];
    }

    public function messages()
    {
        return [
            ''
        ];
    }
}
