<?php
/**
 * //!@# Completed 01-28
 * Migration genrated using LaraAdmin
 * Help: http://laraadmin.com
 */


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dwij\Laraadmin\Models\Module;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Module::generate("Institutions", 'institutions', 'iid', 'fa-building-o', [
            ["iid", "iid", "Integer", true, "", 5, 7, true],
            ["name", "name", "String", true, "", 0, 256, true],
            //["email", "email", "Email", false, "", 0, 256, false], //is needed in future?
			["description", "description", "Textarea", false, "", 0, 1000, false],
            //["phone", "phone", "Mobile", false, "", 0, 20, false], //is needed in future?
            ["hasPaid", "hasPaid", "Radio", false, "0", 0, 0, false, ["0","1"]]            
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('Institutions')) {
            Schema::drop('Institutions');
        }
    }
}
