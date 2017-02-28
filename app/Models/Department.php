<?php
/**
 * //!@# This departments model is only required by seeds/DatabaseSeeder.php
 * //!@# Once DataabaseSeeder.php has been ammended, this file may be deleted.
 *
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $table = 'departments';

    protected $hidden = [

    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];
}