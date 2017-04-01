<?php

namespace App;

class Institutions extends BaseModel
{

    protected $table = "institutions";
    protected $primaryKey = "iid";
    public $timestamps = true;

    //TODO rules
    protected $rules = array(
        'iid' => '',
        'institution_name' => '',
        'description' => '',
        'phone' => '',
        'hasPaid' => '',
        'street_address' => '',
        'city' => '',
        'province' => '',
        'country' => '',
        'postal_code' => '',
        'contact_name' => '',
        'contact_email' => '',
        'contact_phone' => '',
    );

    // TODO customized error messages
    public function messages()
    {
        return [
            '' => '',
        ];
    }

    public function institutions()
    {
        return $this->hasMany('institutions');
    }
}
