<?php

namespace App;

class Centers extends BaseModel
{

    protected $table = "centers";
    protected $primaryKey = "cid";
    public $timestamps = true;

    //TODO rules
    protected $rules = array(
        'name' => 'required|string',
        'email' => 'email',
        'phone' => 'numeric',
        'description' => '',
        'canSupportOnlineExam' => 'boolean',
        'cost' => 'numeric',
        'street_address' => 'string',
        'city' => 'string',
        'province' => 'string',
        'country' => 'string',
        'postal_code' => 'between:6,6',
        'longitude' => '',
        'latitude' => ''
    );

    public function authorize($id)
    {
        return true;
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
