<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centers extends Model
{
    use SoftDeletingTrait;

    protected $table = "centers";

    //only allow the following items to be mass-assigned to our model
    protected $fillable = array('name');

    protected $dates = ['deleted_at'];

    public function centers()
    {
        return $this->hasMany('centers');
    }
}
