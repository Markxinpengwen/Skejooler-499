<?php

namespace App;

class Centers extends BaseModel
{
    protected $table = "centers";
    protected $primaryKey = "cid";

    protected $rules = array(
        'cid' => 'required',
        'name' => 'required',
    );

    public function centers()
    {
        return $this->hasMany('centers');
    }
}
