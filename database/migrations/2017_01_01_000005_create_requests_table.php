<?php

/**
 * Author: Barrett Sharpe
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dwij\Laraadmin\Models\Module;

class CreateRequestsTable extends Migration
{

    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        //Choose a minumum date (arbitrary)
        $MINIMUM_DATE= "1970-01-02 00:00:01";

        Module::generate("Requests", 'requests', 'rid', 'fa-building-o', [
            //IDs
            ["rid", "rid", "Integer", true, "", 6, 6, true],
			["sid", "sid", "Integer", false, "", 6, 6, true], //unique false
			["cid", "cid", "Integer", false, "", 6, 6, true], //unique false
            ["iid", "iid", "Integer", false, "", 6, 6, false],
			//Dates
			["preferred_date_1", "preferred_date_1", "Datetime", false, $MINIMUM_DATE, 0, 0, true],
			["preferred_date_2", "preferred_date_2", "Datetime", false, $MINIMUM_DATE, 0, 0, true],
            ["scheduled_date", "scheduled_date", "Datetime", false, $MINIMUM_DATE, 0, 0, true],
			//Exam Information
			["course_code", "course_code", "String", false, "", 0, 10, true],
			["additional_requirements", "additional_requirements", "Textarea", false, "", 0, 500, false],
			["exam_type", "exam_type", "Dropdown", false, "Final", 0, 0, true, ["Final", "Midterm", "Other"]],
			["exam_medium", "exam_medium", "Dropdown", false, "Paper", 0, 0, true, ["Paper", "Online", "Other"]],
			["computer_required", "computer_required", "Dropdown", false, "No", 0, 0, true, ["No", "Yes"]],
            ["student_approval", "student_approval", "Integer", false, 0, 1, 1, false],
            ["student_notes", "student_notes", "Textarea", false, "None", 0, 500, false], //changed default value
            ["center_approval", "center_approval", "Integer", false, 0, 1, 1, false],
            ["center_notes", "center_notes", "Textarea", false, "None", 0, 500, false] //changed default value
        ]);
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('requests')) {
            Schema::drop('requests');
        }
    }
}
