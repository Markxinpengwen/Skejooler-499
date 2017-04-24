<?php

/**
 * Author: Barrett Sharpe
 */
 
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dwij\Laraadmin\Models\Module;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Module::generate("Students", 'students', 'sid', 'fa-building-o', [
            ["sid", "sid", "Integer", true, "", 5, 7, true],
            ["firstName", "firstName", "String", false, "First", 0, 256, true],
			["lastName", "lastName", "String", false, "Last", 0, 256, true],
			["iid", "iid", "Integer", false, 0, 5, 7, false],
            ["sex", "sex", "Dropdown", false, "not_declared", 0, 0, false, ["not_declared","male","female","transgender"]],
			["age", "age", "Integer", false, 0, 0, 110, false],
			["phone", "phone", "Mobile", false, "0", 0, 15, false] //new default
        ]);
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('students')) {
            Schema::drop('students');
        }
    }
}
