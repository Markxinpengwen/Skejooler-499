<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $rules = array();

    protected $errors;

    public function validate($data)
    {
        $validator = Validate::make($data, $this->rules);
        if($validator->fails)
        {
            $this->errors = $validator->errors;
            return false;
        }

        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}

