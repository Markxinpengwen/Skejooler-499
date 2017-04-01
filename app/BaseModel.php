<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class BaseModel extends Model
{
    protected $rules = array();

    protected $errors;

    public function authorize($id)
    {
        if($id == Auth::id())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function validate($data)
    {
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

