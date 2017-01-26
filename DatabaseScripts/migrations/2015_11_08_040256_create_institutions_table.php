<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionsTable extends Migration
{
    /*
	NOTES:
	- Description is 1000 characters.
	- hasPaid should be a tinyint, and 0 the dafault will represent NOT PAID.
	*/
	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Institutions', function (Blueprint $table) {
            $table->increments('iid');           
			$table->string('name')->unique()->nullable(false); //unique institution?
            $table->string('description', 1000)->nullable();
			$table->boolean('hasPaid')->default(0);
            $table->rememberToken();
            $table->timestamps();
			//Engine
			$table->engine = 'InnoDB';
        });
		
		//Auto-Increment
		DB::update("ALTER TABLE Institutions AUTO_INCREMENT = 10000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Institutions');
    }
}
