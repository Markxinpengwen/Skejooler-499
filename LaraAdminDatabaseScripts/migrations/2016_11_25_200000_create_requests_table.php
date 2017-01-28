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
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Module::generate("Requests", 'requests', 'rid', 'fa-building-o', [
            ["rid", "rid", "Integer", true, "", 6, 6, true],
			["student", "student", "Integer", true, "", 6, 6, true],
			["center", "center", "Integer", true, "", 6, 6, true],
			["preferred_date_1", "preferred_date_1", "Date", false, "date('Y-m-d')", 0, 0, true],
			["preferred_date_2", "preferred_date_2", "Date", false, "date('Y-m-d')", 0, 0, true],
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
