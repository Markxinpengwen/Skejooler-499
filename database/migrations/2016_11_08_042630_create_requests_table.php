<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /*
	NOTES:
	- //*1 Do we have the approval_status boolean here? Would that pose a risk of 
		students being able to modify that value themselves, or would we have
		to restrict that using a MySQL view?
	- //** These referential actions for FK's 'student' and 'center' might have
		to be changed in the future to allow preservation of information.
	- NEED TO IMPLEMENT preferred TIME.
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
            //Request Identifiers
			$table->increments('rid');
			$table->integer('student')->unsigned();
			$table->foreign('student')->references('sid')->on('Students')->onDelete('cascade')->onUpdate('cascade'); //**
			$table->integer('center')->unsigned()->nullable(); //center must be nullable, for requests to unregistered centers without a CID.
			$table->foreign('center')->references('cid')->on('Centers')->onDelete('cascade')->onUpdate('cascade'); //**
			//School Information
			$table->string('center_name')->nullable(false);
			$table->string('center_street_name')->nullable(false);
			$table->string('center_city')->nullable(false);
			$table->enum('center_province', ['British_Columbia','Alberta','Sasketchewan', 'Manitoba','Ontario','Quebec','Nova_Scotia','Newfoundland_and_Labrador', 'New_Brunswick', 'Prince_Edward_Island','Yukon','Northwest_Territories', 'Nunavut'])->default('British_Columbia')->nullable(false);
			$table->enum('center_country', ['Canada'])->default('Canada')->nullable(false);
			$table->string('center_postal_code')->nullable(false);
			$table->string('center_contact')->nullable(); 
			$table->string('center_contact_email')->nullable();
			$table->string('center_contact_number')->nullable();
			//other attributes
			$table->enum('preferred_date_1', ['Any_Day','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'])->default('Any_Day')->nullable(false);
			$table->enum('preferred_date_2', ['Any_Day','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'])->default('Any_Day')->nullable(false);
			$table->time('preferred_time')->nullable(false);
			$table->string('course_code',20)->nullable(false);
			$table->string('additional_requirements',500)->nullable();
			$table->enum('exam_type',['Final','Midterm','Other'])->default('Final')->nullable(false);
			$table->enum('exam_medium',['Paper','Online','Other'])->default('Paper')->nullable(false);
			$table->boolean('approval_status')->default(0); //*1
			//Request Metainformation
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
