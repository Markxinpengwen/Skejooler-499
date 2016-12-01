<?php
/**
 * Migration genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestmodulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // This Module has been deleted.
        // You can remove this file after migrate:reset
        
		if (Schema::hasTable('testmodules')) {
            Schema::drop('testmodules');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('testmodules')) {
            Schema::drop('testmodules');
        }
    }
}
