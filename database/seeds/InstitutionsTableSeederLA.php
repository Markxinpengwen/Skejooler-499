<?php

use Illuminate\Database\Seeder;

// require the Faker autoloader
require_once 'vendor/fzaninotto/faker/src/autoload.php'; //old seeder works fine in LA

class InstitutionsTableSeederLA extends Seeder
{
	/**
     * Seed the Institutions Table, given predefined values.
     * 
     * @return void
     */
    public function run()
    {
        //-------------------------------------------------------------------------------------
        //STEP 1) SETUP
        //-------------------------------------------------------------------------------------

        //Constants
		$NUM_INSTITUTIONS=5;
		$DEFAULT_AUTO_INCREMENT = 10000;
		$FAKER_SEED=1234;
		
		echo "InstitutionTableSeeder] Seeding ".$NUM_INSTITUTIONS." Institutions.\n";
		
		//Faker Instantiation
		$faker = Faker\Factory::create();

		//Choice for Standardized Seed
        echo "\nUse Standardized Seed? (y/n):";
        $fp = fopen("php://stdin","r");
        $input = rtrim(fgets($fp, 1024));
        if($input=="y" || $input=="Y"){
            $faker->seed($FAKER_SEED);
        }

		//Acquire initial auto_increment value from institutions table, for start index when seeding.
		$result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Institutions'"));
        $result = json_decode(json_encode($result),true); //LA Workaround. Boolean true for returned as associative array.
        //var_dump($result);
		$iid = intval($result[0]["Auto_increment"]);

		//Check whether to set initial auto increment to default constant
		if($iid!=0 && $iid!=1){
			echo "Next Auto_Increment value is: ".$iid.".";
		}else{
			$iid = $DEFAULT_AUTO_INCREMENT;
			echo "Next Auto_Increment value was 0. Setting to default value of ".$iid.".";
		}

        //--------------------------------------------------------------------------------
        //STEP 2) CREATE / INSERT INSTITUTIONS INTO INSTITUTIONS TABLE
        //--------------------------------------------------------------------------------

		//Insert each created Record into the database.
		for($i = 0; $i < $NUM_INSTITUTIONS; $i++) {
			
			//Name for echoing
			$tmp = $faker->company() . " University";
			
			//sequential inserts
			DB::table('Institutions')->insert(
				[					
					'iid' => $iid,
					'institution_name' => $tmp,
					'description' => $faker->bs(). " ".$faker->bs(). ", is our description.",
                    'phone' => substr($faker->e164PhoneNumber,-11),
					'hasPaid' => "".rand(0,1)."", //String for LA
                    'street_address' => $faker->streetAddress(),
                    'city' => $faker->city(),
                    'province' => 'British_Columbia',
                    'country' => 'Canada',
                    'postal_code' => substr($faker->e164PhoneNumber,-6),
                    'contact_name' => $faker->firstName . " " . $faker->lastName,
					'contact_phone' => substr($faker->e164PhoneNumber,-11),
					'contact_email' => $faker->safeEmail(),
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
