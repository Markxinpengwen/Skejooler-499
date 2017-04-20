<?php

/**
 * Author: Brett Schaad
 */

namespace App;

class Centers extends BaseModel
{
    // sets table and primary key for database access, and sets timestamps to be updated
    protected $table = "centers";
    protected $primaryKey = "cid";
    public $timestamps = true;

    // validation rules array
    protected $rules = array(
        'id' => '',
        'cid' => '',
        'center_name' => 'required|string', // TODO add unique
        'center_email' => 'email',
        'phone' => 'numeric', // TODO needs a valid change into mobile 0 - 20 accepts valid characters
        'description' => '', // TODO text area 0 - 1000
        'canSupportOnlineExam' => 'boolean',
        'cost' => 'numeric', // TODO 15 digits total, 2 past decimal OR 0 - 11 digits
        'street_address' => 'string', // TODO 3 - 100
        'city' => 'string', // TODO 3 - 100
        'province' => 'string',
        'country' => 'string',
        'postal_code' => 'between:5,6|string',
        'longitude' => '',
        'latitude' => '',
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
     * Center model's relational schema
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function centers()
    {
        return $this->hasMany('centers');
    }
}
