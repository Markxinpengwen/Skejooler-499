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
        'email' => 'email', //TODO delete
        //'center_email' => 'email',
        'phone' => 'numeric|between', // TODO needs a valid change into mobile 0 - 20 accepts valid characters
        'description' => '', // text area 0 - 1000
        'canSupportOnlineExam' => 'boolean', //boolean
        'cost' => 'numeric', // 15 digits total, 2 past decimal OR 0 - 11 digits
        'street_address' => 'string', // 3 - 100
        'city' => 'string', //3 - 100
        'province' => 'string',
        'country' => 'string',
        'postal_code' => 'between:5,6|string',
    );

    protected $rules2 = array(
        'email' => 'unique:centers|email',
    );

    // TODO authorize statement
    public function authorize($id)
    {
        return true;
    }

    // TODO customized error messages
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
