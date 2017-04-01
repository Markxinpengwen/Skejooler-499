<?php

namespace App;

class Students extends BaseModel
{

    protected $table = "students";
    protected $primaryKey = "sid";
    public $timestamps = true;

    //TODO rules
    protected $rules = array(
        'sid' => '',
        'firstName' => '',
        'lastName' => '',
        'iid' => '',
        'sex' => '',
        'age' => '',
        'phone' => '',
    );

    // TODO customized error messages
    public function messages()
    {
        return [
            '' => '',
        ];
    }

    public function students()
    {
        return $this->hasMany('students');
    }
}
