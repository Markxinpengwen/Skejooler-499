<?php

namespace App;
use app\Http\Requests\YourRequest as Request;

class Centers extends BaseModel
{

    protected $table = "centers";
    protected $primaryKey = "cid";
    public $timestamps = true;

    protected $rules = array(
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
    );

    public function validate($data)
    {
        $validator = Validate::make($data, $this->rules);
        if($validator->fails)
        {
            $this->errors = $validator->errors;
            return false;

        }
        else
        {
            return true;
        }
    }

    public function messages()
    {
        return [
            '' => '',
        ];
    }

    public function centers()
    {
        return $this->hasMany('centers');
    }
}
