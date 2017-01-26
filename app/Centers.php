<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centers extends Model
{
    protected $table = "centers";
    protected $primaryKey = "cid";

    public function centers()
    {
        return $this->hasMany('centers');
    }
}
