<?php

/**
 * Author: Brett Schaad
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Support\Facades\Auth as Auth;

class BaseModel extends Model
{
    // base empty rules array and errors
    protected $rules = array();
    protected $errors;

    /**
     * Authentication method that takes in $id and test against Auth::id(), the currently logged in user, to see if they match
     * @param $id
     * @return bool
     */
    public function authorize($id)
    {
        if($id == Auth::id())
        {
            // users match, authentication successful
            return true;
        }
        else
        {
            // users do not match, authentication failed
            return false;
        }
    }

    /**
     * Validation method to determine if input from user is valid against the rules for the given model
     * @param $data
     * @return bool
     */
    public function validate($data)
    {
        // creates new validator using input data and rules array from given model
        $validator = Validator::make($data, $this->rules);

        // tests validity
        if($validator->fails())
        {
            // non valid input, validation failed
            $this->errors = $validator->errors()->toArray();
            return false;
        }
        else
        {
            // valid input, validation successful
            return true;
        }
    }
}

