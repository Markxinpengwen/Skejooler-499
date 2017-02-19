<?php
/**
 * //!@# Completed 01-28
 * Migration genrated using LaraAdmin
 * Help: http://laraadmin.com
 */
 
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dwij\Laraadmin\Models\Module;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Module::generate("Users", 'users', 'uid', 'fa-group', [
            ["uid", "uid", "Integer", true, "", 0, 5, 7, true],
			["email", "email", "Email", true, "", 0, 250, true],
            ["name", "Name", "Name", false, 0, 40, false], //!@# workaround for login requiring name.
            //["context_id", "Context", "Integer", false, "0", 0, 0, false],
            ["password", "password", "Password", false, "", 6, 250, true],
            ["salt", "salt", "String", true, "", 6, 250, true],
            ["utype", "utype", "Radio", false, 1, 0, 0, true, [0,1,2]]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('users')) {
            Schema::drop('users');
        }
    }
}
