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
        if(true)
        {
            return true;
        }
        return false;
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
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            ''
        ];
    }
}
