<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
	/*
	NOTE: 
	By using the enum type for gender, the following Laravel functionality restrictions are applied:
		- "Modifying any column in a table that also has a column of type enum is not currently supported."
		- "Renaming any column in a table that also has a column of type enum is not currently supported."
	
	//*1: Nullable doesn't seem to be required to uphold the FK constraint here.
	
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
        Schema::create('Students', function (Blueprint $table) {
			$table->integer('sid')->unsigned(); //*1
			$table->foreign('sid')->references('uid')->on('Users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('firstName')->nullable(false);
			$table->string('lastName')->nullable(false);
			$table->string('email')->nullable(false);
			$table->integer('institution')->unsigned()->nullable();
			$table->foreign('institution')->references('iid')->on('Institutions')->onDelete('set null')->onUpdate('cascade');
			$table->enum('gender', ['not_declared','male','female','transgender'])->default('not_declared');
			$table->tinyInteger('age')->unsigned();
			$table->string('phone',11);
            $table->timestamps();
			//Engine
			$table->engine = 'InnoDB';
        });
		
		//Auto-Increment
		DB::update("ALTER TABLE Students AUTO_INCREMENT = 10000;");
    }

	
	
    /**
     * Reverse this migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Students');
    }
}
