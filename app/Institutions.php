<?php

/**
 * Author: Brett Schaad
 */

namespace App;

class Institutions extends BaseModel
{
    // sets table and primary key for database access, and sets timestamps to be updated
    protected $table = "institutions";
    protected $primaryKey = "iid";
    public $timestamps = true;

    // validation rules array
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
     * Institutions model's relational schema
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function institutions()
    {
        return $this->hasMany('institutions');
    }
}
