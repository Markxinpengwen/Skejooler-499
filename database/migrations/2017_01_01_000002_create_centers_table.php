<?php

/**
 * Author: Barrett Sharpe
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dwij\Laraadmin\Models\Module;

class CreateCentersTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Module::generate("Centers", 'centers', 'cid', 'fa-building-o', [
            ["cid", "cid", "Integer", true, "", 6, 6, true],
            ["center_name", "name", "String", true, "", 0, 256, true],
            ["center_email", "center_email", "Email", false, "", 0, 256, false],
            ["phone", "phone", "Mobile", false, "0", 0, 20, false], //new default value
            ["description", "description", "Textarea", false, "No Description Given", 0, 1000, false], //new default
            ["canSupportOnlineExam", "canSupportOnlineExam", "Radio", false, "0", 0, 0, false, ["0","1"]],
            ["cost", "cost", "Currency", false, 0.0, 0, 11, false], //new default
            ["street_address", "street_address", "String", false, "No Address Listed", 3, 100, true],
            ["city", "city", "String", false, "No City Listed", 3, 100, true],
            ["province", "province", "Dropdown", false, "British_Columbia", 0, 0, true, ["British_Columbia","Alberta","Sasketchewan","Manitoba","Ontario","Quebec","Nova_Scotia","Newfoundland_and_Labrador","New_Brunswick","Prince_Edward_Island","Yukon","Northwest_Territories","Nunavut"]],
            ["country", "country", "Dropdown", false, "Canada", 0, 0, true, ["Canada"]],
            ["postal_code", "postal_code", "String", false, "000000", 5, 6, true], //New default
            ["longitude", "longitude", "Float", false, "0.000000", 8, 11, false],
            ["latitude", "latitude", "Float", false, "0.000000", 8, 11, false]
        ]);
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('centers')) {
            Schema::drop('centers');
        }
    }
}
