<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class BaseModel extends Model
{
    protected $rules = array();

    protected $errors;

    public function validate($data, $email)
    {
        //if()
        $validator = Validator::make($data, $this->rules);
        if($validator->fails())
        {
            $this->errors = $validator->errors()->toArray();
            return false;
        }
        else
        {
            return true;
        }
    }
}

