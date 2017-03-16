<?php
/**
 * Created by PhpStorm.
 * User: brett
 * Date: 2017-03-02
 * Time: 12:40 PM
 */

namespace App;


class Requests extends BaseModel
{

    protected $table = "requests";
    protected $primaryKey = "cid"; // TODO add functionality for multiple primary keys
    public $timestamps = true;

    // TODO rules
    protected $rules = array(
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
    );

    // TODO authorize statement
    public function authorize($id)
    {
        return true;
    }

    // TODO customized error messages
    public function messages()
    {
        return [
            '' => '',
        ];
    }

    public function centers()
    {
        return $this->hasMany('centers');
    }
}
