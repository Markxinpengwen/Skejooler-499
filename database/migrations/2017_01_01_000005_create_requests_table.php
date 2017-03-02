<?php
/**
 * //!@# Completed 01-28
 * Migration genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dwij\Laraadmin\Models\Module;

class CreateRequestsTable extends Migration
{
    //Minimum date constant


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $MINIMUM_DATE= "1970-01-01 00:00:00";

        Module::generate("Requests", 'requests', 'rid', 'fa-building-o', [
            ["rid", "rid", "Integer", true, "", 6, 6, true],
			["student", "student", "Integer", false, "", 6, 6, true], //first bool (iUnique) to false
			["center", "center", "Integer", false, "", 6, 6, true], //first bool (iUnique) to false
			["preferred_date_1", "preferred_date_1", "Datetime", false, $MINIMUM_DATE, 0, 0, true],
			["preferred_date_2", "preferred_date_2", "Datetime", false, $MINIMUM_DATE, 0, 0, true],
            ["scheduled_date", "scheduled_date", "Datetime", false, $MINIMUM_DATE, 0, 0, true],
			["course_code", "course_code", "String", false, "", 0, 10, true],
			["additional_requirements", "additional_requirements", "Textarea", false, "", 0, 500, false],
			["exam_type", "exam_type", "Dropdown", false, "Final", 0, 0, true, ["Final", "Midterm", "Other"]],
			["exam_medium", "exam_medium", "Dropdown", false, "Paper", 0, 0, true, ["Paper", "Online", "Other"]],
			["approval_status", "approval_status", "Radio", false, "0", 0, 0, false, ["0","1"]]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('Requests')) {
            Schema::drop('Requests');
        }
    }
}
