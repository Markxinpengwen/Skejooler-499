<?php

namespace App;

class Students extends BaseModel
{

    protected $table = "students";
    protected $primaryKey = "sid";
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

    public function centers()
    {
        return $this->hasMany('centers');
    }
}
