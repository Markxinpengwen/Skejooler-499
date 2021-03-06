<?php

/**
 * Author: Barrett Sharpe
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
        //Choose a minimum date value (arbitrary)
        $MINIMUM_DATE= "1970-01-02 00:00:01";

        Module::generate("Users", 'users', 'uid', 'fa-group', [
            ["uid", "User ID", "Integer", true, "", 0, 5, 7, true],
			["email", "Email", "Email", true, "", 0, 250, true],
            ["password", "password", "Password", false, "", 6, 250, true],
            ["salt", "salt", "String", true, "", 6, 250, true],
            ["type", "Type", "Dropdown", false, "student", 0, 0, true, ["student", "center", "admin"]],
            ["last_logged_in", "last_logged_in", "Datetime", false, $MINIMUM_DATE, 0, 0, false]
        ]);
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('users')) {
            Schema::drop('users');
        }
    }
}
