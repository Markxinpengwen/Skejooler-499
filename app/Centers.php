<?php

namespace App;

class Centers extends BaseModel
{

    protected $table = "centers";
    protected $primaryKey = "cid";
    public $timestamps = true;

    //TODO rules
    protected $rules = array(
        'name' => 'required|string', // TODO add unique
        'center_email' => 'email',
        'phone' => 'numeric', // TODO needs a valid change into mobile 0 - 20 accepts valid characters
        'description' => '', // TODO text area 0 - 1000
        'canSupportOnlineExam' => 'boolean',
        'cost' => 'numeric', // TODO 15 digits total, 2 past decimal OR 0 - 11 digits
        'street_address' => 'string', // TODO 3 - 100
        'city' => 'string', // TODO 3 - 100
        'province' => 'string',
        'country' => 'string',
        'postal_code' => 'between:5,6|string',
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
