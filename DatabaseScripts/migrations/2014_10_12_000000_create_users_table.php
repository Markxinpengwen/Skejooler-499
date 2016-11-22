<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /*
	//!@# NOTE: implement 'uType' in seeder file
	*/
	
	
	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->increments('id');           
			$table->string('email')->unique()->nullable(false);
            $table->string('passwordHash');
			$table->string('salt');
			$table->tinyInteger('utype')->unsigned()->nullable(false)->defualt(1); //'utype' is in Mark's code. Change later if needed. //DEfault 1 is Student
			//$table->tinyInteger('utype')->unsigned()->defualt(1); //'utype' is in Mark's code. Change later if needed.
            $table->rememberToken();
            $table->timestamps();
			//Engine
			$table->engine = 'InnoDB';
        });
		
		//Auto-Increment
		DB::update("ALTER TABLE Users AUTO_INCREMENT = 10000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Users');
    }
}
