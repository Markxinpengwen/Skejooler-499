<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentersTable extends Migration
{
	/*
	NOTES: 
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
		Schema::create('Centers', function (Blueprint $table) {
			$table->integer('cid')->unsigned(); //*1
			$table->foreign('cid')->references('uid')->on('Users')->onDelete('cascade')->onUpdate('cascade');
			$table->string('name')->nullable(false);
			$table->string('email')->nullable();
			$table->string('phone',11)->nullable();
			$table->string('description',1000)->nullable();
			$table->boolean('canSupportOnlineExam');
			$table->decimal('cost',6,2)->nullable();
			//Address
			$table->string('street_name')->nullable(false);
			$table->string('city')->nullable(false);
			$table->enum('province', ['British_Columbia','Alberta','Sasketchewan', 'Manitoba','Ontario','Quebec','Nova_Scotia','Newfoundland_and_Labrador', 'New_Brunswick', 'Prince_Edward_Island','Yukon','Northwest_Territories', 'Nunavut'])->default('British_Columbia')->nullable(false);
			$table->enum('country', ['Canada'])->default('Canada')->nullable(false);
			$table->string('postal_code',6)->nullable(false);
			$table->float('longitude',10,6)->default(NULL)->nullable();
			$table->float('latitude',10,6)->default(NULL)->nullable();
			$table->timestamps();
			//Engine
			$table->engine = 'InnoDB';
		});
		
		//Auto-Increment
		DB::update("ALTER TABLE Centers AUTO_INCREMENT = 10000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Centers');
    }
}
