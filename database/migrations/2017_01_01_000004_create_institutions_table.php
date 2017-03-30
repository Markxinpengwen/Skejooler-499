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
            ["institution_name", "institution_name", "String", true, "", 0, 256, true],
            ["description", "description", "Textarea", false, "", 0, 1000, false],
            ["phone", "phone", "Mobile", false, "", 0, 20, false], //is needed in future?
            ["hasPaid", "hasPaid", "Radio", false, "0", 0, 0, false, ["0","1"]],
            //Location
            ["street_address", "street_address", "String", false, "No Address Listed", 3, 100, true],
            ["city", "city", "String", false, "No City Listed", 3, 100, true],
            ["province", "province", "Dropdown", false, "British_Columbia", 0, 0, true, ["British_Columbia","Alberta","Sasketchewan","Manitoba","Ontario","Quebec","Nova_Scotia","Newfoundland_and_Labrador","New_Brunswick","Prince_Edward_Island","Yukon","Northwest_Territories","Nunavut"]],
            ["country", "country", "Dropdown", false, "Canada", 0, 0, true, ["Canada"]],
            ["postal_code", "postal_code", "String", false, "000000", 5, 6, true],
            //Contact
            ["contact_name", "contact_name", "String", true, "", 0, 256, true],
            ["contact_email", "contact_email", "Email", false, "", 0, 256, false],
            ["contact_phone", "contact_phone", "Mobile", false, "", 0, 20, false]
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
