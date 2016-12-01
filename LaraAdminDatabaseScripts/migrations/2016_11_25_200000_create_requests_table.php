<?php
/**
 * Migration genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

 //Version 1: Untested
 
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
			//Center Info
			["center_name", "center_name", "String", true, "", 0, 256, true],
			["center_street_address", "center_street_address", "String", false, "", 3, 100, true],
            ["center_city", "center_city", "String", false, "", 3, 100, true],
            ["center_province", "center_province", "Dropdown", false, "British_Columbia", 0, 0, true, ["British_Columbia","Alberta","Sasketchewan","Manitoba","Ontario","Quebec","Nova_Scotia","Newfoundland_and_Labrador","New_Brunswick","Prince_Edward_Island","Yukon","Northwest_Territories","Nunavut"]],
            ["center_country", "center_country", "Dropdown", false, "Canada", 0, 0, true, ["Canada"]],
            ["center_postal_code", "center_postal_code", "String", false, "", 5, 6, true],
			["center_contact", "center_contact", "String", false, "", 0, 200, false],
            ["center_contact_email", "center_contact_email", "Email", false, "", 0, 256, false],
            ["center_contact_phone", "center_contact_phone", "Mobile", false, "", 0, 20, false],
            //Other Attributes
			["preferred_date_1", "preferred_date_1", "Date", false, "date('Y-m-d')", 0, 0, true],
			["preferred_date_2", "preferred_date_2", "Date", false, "date('Y-m-d')", 0, 0, true],
			["course_code", "course_code", "String", false, "", 0, 10, true],
			["additional_requirements", "additional_requirements", "Textarea", false, "", 0, 500, false],
			["exam_type", "exam_type", "Dropdown", false, "Final", 0, 0, true, ["Final", "Midterm", "Other"]],
			["exam_medium", "exam_medium", "Dropdown", false, "Paper", 0, 0, true, ["Paper", "Online", "Other"]],
			["approval_status", "approval_status", "Radio", false, "0", 0, 0, false, ["0","1"]]
        ]);
		
		/*
		Row Format:
		["field_name_db", "Label", "UI Type", "Unique", "Default_Value", "min_length", "max_length", "Required", "Pop_values"]
        Module::generate("Module_Name", "Table_Name", "view_column_name" "Fields_Array");
        
		Module::generate("Books", 'books', 'name', [
            ["address",     "Address",      "Address",  false, "",          0,  1000,   true],
            ["restricted",  "Restricted",   "Checkbox", false, false,       0,  0,      false],
            ["price",       "Price",        "Currency", false, 0.0,         0,  0,      true],
            ["date_release", "Date of Release", "Date", false, "date('Y-m-d')", 0, 0,   false],
            ["time_started", "Start Time",  "Datetime", false, "date('Y-m-d H:i:s')", 0, 0, false],
            ["weight",      "Weight",       "Decimal",  false, 0.0,         0,  20,     true],
            ["publisher",   "Publisher",    "Dropdown", false, "Marvel",    0,  0,      false, ["Bloomsbury","Marvel","Universal"]],
            ["publisher",   "Publisher",    "Dropdown", false, 3,           0,  0,      false, "@publishers"],
            ["email",       "Email",        "Email",    false, "",          0,  0,      false],
            ["file",        "File",         "File",     false, "",          0,  1,      false],
            ["files",       "Files",        "Files",    false, "",          0,  10,     false],
            ["weight",      "Weight",       "Float",    false, 0.0,         0,  20.00,  true],
            ["biography",   "Biography",    "HTML",     false, "<p>This is description</p>", 0, 0, true],
            ["profile_image", "Profile Image", "Image", false, "img_path.jpg", 0, 250,  false],
            ["pages",       "Pages",        "Integer",  false, 0,           0,  5000,   false],
            ["mobile",      "Mobile",       "Mobile",   false, "+91  8888888888", 0, 20,false],
            ["media_type",  "Media Type",   "Multiselect", false, ["Audiobook"], 0, 0,  false, ["Print","Audiobook","E-book"]],
            ["media_type",  "Media Type",   "Multiselect", false, [2,3],    0,  0,      false, "@media_types"],
            ["name",        "Name",         "Name",     false, "John Doe",  5,  250,    true],
            ["password",    "Password",     "Password", false, "",          6,  250,    true],
            ["status",      "Status",       "Radio",    false, "Published", 0,  0,      false, ["Draft","Published","Unpublished"]],
            ["author",      "Author",       "String",   false, "JRR Tolkien", 0, 250,   true],
            ["genre",       "Genre",        "Taginput", false, ["Fantacy","Adventure"], 0, 0, false],
            ["description", "Description",  "Textarea", false, "",          0,  1000,   false],
            ["short_intro", "Introduction", "TextField",false, "",          5,  250,    true],
            ["website",     "Website",      "URL",      false, "http://dwij.in", 0, 0,  false],
        ]);
		*/
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
