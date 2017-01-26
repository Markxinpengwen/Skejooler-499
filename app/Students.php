<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = "students";
    protected $primaryKey = "sid";

    public function students()
    {
        return $this->hasMany('students');
    }
}