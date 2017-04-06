<?php

/**
 * Author: Brett Schaad
 */

namespace App;

class Students extends BaseModel
{
    // sets table and primary key for database access, and sets timestamps to be updated
    protected $table = "students";
    protected $primaryKey = "sid";
    public $timestamps = true;

    // validation rules array
    protected $rules = array(
        'id' => 'id',
        'sid' => '',
        'firstName' => '',
        'lastName' => '',
        'iid' => '',
        'sex' => '',
        'age' => '',
        'phone' => '',
    );

    /**
     * Create custom error messages
     * @return array
     */
    public function messages()
    {
        return [
            '' => '',
        ];
    }

    /**
     * Student model's relational schema
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany('students');
    }
}
