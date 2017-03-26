<?php

namespace App;

class Institutions extends BaseModel
{

    protected $table = "institutions";
    protected $primaryKey = "iid";
    public $timestamps = true;

    //TODO rules
    protected $rules = array(
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
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

    public function institutions()
    {
        return $this->hasMany('institutions');
    }
}
