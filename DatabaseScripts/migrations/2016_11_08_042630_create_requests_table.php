<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /*
	NOTES:
	- //*1 Do we have the isAccepted boolean here? Would that pose a risk of 
		students being able to modify that value themselves, or would we have
		to restrict that using a MySQL view?
	- //** These referential actions for FK's 'student' and 'center' might have
		to be changed in the future to allow preservation of information.
	*/
	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//Enable FK
		Schema::enableForeignKeyConstraints();
		//Schema
        Schema::create('Requests', function (Blueprint $table) {
            $table->increments('rid');
			$table->integer('student')->unsigned();
			$table->foreign('student')->references('sid')->on('Students')->onDelete('cascade')->onUpdate('cascade'); //**
			$table->integer('center')->unsigned();
			$table->foreign('center')->references('cid')->on('Centers')->onDelete('cascade')->onUpdate('cascade'); //**
			$table->boolean('isAccepted')->default(0); //*1
            $table->rememberToken();
            $table->timestamps();
			//Engine
			$table->engine = 'InnoDB';
        });
		
		//Auto-Increment
		DB::update("ALTER TABLE Requests AUTO_INCREMENT = 10000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Requests');
    }
}
