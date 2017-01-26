<?php

use Illuminate\Database\Seeder;

// require the Faker autoloader
require_once 'vendor/fzaninotto/faker/src/autoload.php';

class InstitutionsTableSeederLA extends Seeder
{
	/**
	* NOTES:
	* - Timestamps function in LA?
	* - RememberToken exist in LA?
	*/
	
	//!@#Version 1 (untested)
	
	/**
     * Seed the Institutions Table, given predefined values.
     * 
     * @return void
     */
    public function run()
    {
        //Constants
		$NUM_INSTITUTIONS=3;
		$DEFAULT_AUTO_INCREMENT = 10000;
		
		//Echo
		echo "InstitutionTableSeeder] Seeding ".$NUM_INSTITUTIONS." Institutions.\n";
		
		//Faker
		$faker = Faker\Factory::create();
		
		//Acquire initial auto_increment value on institutions
		$result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Institutions'"));
		$iid = $result[0]['Auto_increment'];
		if($iid!=0){
			echo "Next Auto_Increment value is: ".$iid.".";
		}else{
			$iid = $DEFAULT_AUTO_INCREMENT;
			echo "Next Auto_Increment value was 0. Setting to default value of ".$iid.".";
		}
		
		//Insert each created Record into the database.
		for($i = 0; $i < $NUM_INSTITUTIONS; $i++) {
			
			//Name for echoing
			$tmp = $faker->company() . " University";
			
			//use 'insertGetId' for grabbing auto-incremented field
			$iid = DB::table('Institutions')->insertGetId(
				[					
					'iid' => $iid,
					'name' => $tmp,
					'description' => $faker->bs(). " ".$faker->bs(). ", is our description.",
					'hasPaid' => rand(0,1),
					//'remember_token' => str_random(100), //no longer used in V.1
					'created_at' => $faker->dateTimeThisDecade($max = 'now'),
					'updated_at' => $faker->dateTimeThisMonth($max = 'now')
				]
			);
			
			//Echo Record, and Increment iid
			echo "\n\t- Institution ". $iid .": ". $tmp .".";
			$iid++;
		}//for
		echo "\n";
    }//run
	
}//class
