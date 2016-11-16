<?php

use Illuminate\Database\Seeder;

// require the Faker autoloader
require_once 'vendor/fzaninotto/faker/src/autoload.php';

class GiantTableSeeder extends Seeder
{
	
	/**
     * Seeds ALL the Dependant tables
     *
     * @return void
     */
    public function run()
    {
        
		//-------------------------------------------------------------------------------------
		//STEP 1) SETUP
		//-------------------------------------------------------------------------------------
		
		//Constants
		$NUM_STUDENTS=20;
		$NUM_CENTERS=10;
		
		//Auto_Increment default values
		$USERS_DEFAULT_AUTO_INCREMENT = 10000;
		$STUDENTS_DEFAULT_AUTO_INCREMENT = 10000;
		$CENTERS_DEFAULT_AUTO_INCREMENT = 10000;
		
		//Print
		echo "GiantTableSeeder] Seeding: ".($NUM_STUDENTS+$NUM_CENTERS). " Users, ".$NUM_STUDENTS. " Students, and ".$NUM_CENTERS . " Centers.\n";
		
		//Faker
		$faker = Faker\Factory::create();
		
		//Acquire initial auto_increment value from database, for all tables, and then print them.
		//Students
		$result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Students'"));
		$sid = $result[0]['Auto_increment'];
		if($sid!=0){
			echo "Students Auto_Increment value is: ".$sid.".\n";
		}else{
			$sid = $STUDENTS_DEFAULT_AUTO_INCREMENT;
			echo "Students next Auto_Increment value was 0.\n\tSetting to default value of ".$sid.".\n";
		}
		//Users
		$result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Users'"));
		$uid = $result[0]['Auto_increment'];
		if($uid!=0){
			echo "Users Auto_Increment value is: ".$uid.".\n";
		}else{
			$uid = $USERS_DEFAULT_AUTO_INCREMENT;
			echo "Users next Auto_Increment value was 0.\n\tSetting to default value of ".$uid.".\n";
		}
		//Centers
		$result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Centers'"));
		$cid = $result[0]['Auto_increment'];
		if($cid!=0){
			echo "Centers Auto_Increment value is: ".$cid.".\n";
		}else{
			$cid = $CENTERS_DEFAULT_AUTO_INCREMENT;
			echo "Centers next Auto_Increment value was 0.\n\tSetting to default value of ".$cid.".\n";
		}
		
		//First, we will create the Student and Center arrays with all of the values in them.
		//Second, we will create the User table, and entries, based on the values in the Student/Center arrays.
		
		//--------------------------------------------------------------------------------
		//STEP 2) CREATING VALUES FOR STUDENT, CENTERS, AND USER TABLES
		//--------------------------------------------------------------------------------
		
		//Student Array
		$students = array();
		for($i = 0; $i < $NUM_STUDENTS; $i++) {
			$students[$i] = [
				'sid' => 0,
				'firstName' => $faker->firstName,
				'lastName' => $faker->lastName,
				'email' => $faker->unique()->safeEmail,
				'gender' => (rand(0,1) == 1 ? "male" : "female"),
				'age' => (rand(0,40)+ 20),
				'phone' => substr($faker->e164PhoneNumber,-11),
				'created_at' => $faker->dateTimeThisDecade($max = 'now'),
				'updated_at' => $faker->dateTimeThisMonth($max = 'now')
			];
		}//for
		echo "\nGenerated ". $NUM_STUDENTS . " Students.";
	
		//Centers Array
		$centers = array();
		for($i = 0; $i < $NUM_CENTERS; $i++) {
			$centers[$i] = [
				'cid' => 0, //determined later
				'name' => $faker->company() . " Center",
				'email' => $faker->unique()->safeEmail,
				'phone' => substr($faker->e164PhoneNumber,-11),
				'description' => $faker->bs() .$faker->bs() .$faker->bs(),
				'canSupportOnlineExam' => rand(0,1),
				'cost' => rand(40,400),
				'street_name' => $faker->streetAddress(),
				'city' => $faker->city(),
				'province' => 'British_Columbia',
				'country' => 'Canada',
				'postal_code' => "A1B2C3",
				'longitude' => $faker->longitude($max = -119.2, $min = -127.0 ),
				'latitude' => $faker->latitude($max = 52.11, $min = 49.04 )
			];
		}//for
		echo "\nGenerated ". $NUM_CENTERS . " Centers.";
		
		
		//Users Array		
		$users = array();
		//Same Password for all users
		$password="password";		
		//Populate array
		for($i = 0; $i < ($NUM_CENTERS+$NUM_STUDENTS); $i++) {
			//Recalculate Time, and Hash Options
			$now = getdate();
			$options = [
				'cost' => 10,
				'salt' => str_random(22) //22 required minimum //str_random safe? random_bytes
			];
			
			//Username, if Student or Center
			if($i < $NUM_CENTERS){
				//Center: First 10 letters of name + random digit 0-9
				$username = substr($centers[$i]['name'],0,10) . rand(0,9);
			}else{
				//Student: First 5 letters of First and Last Names
				$username = substr($students[($i-$NUM_CENTERS)]['firstName'],0,5) . substr($students[$i-$NUM_CENTERS]['lastName'],0,5);
			}

			$users[$i] = [
				'uid' => $uid, //remember uid is incremented below
				'username' => $username,
				'salt' => $options['salt'],
				'passwordHash' => password_hash($password, PASSWORD_DEFAULT, $options),
				'remember_token' => str_random(100),
				'created_at' => $faker->dateTimeThisDecade($max = 'now'),
				'updated_at' => $faker->dateTimeThisMonth($max = 'now')
			];
			
			//Assign this UID to either Student or Center
			if($i<$NUM_CENTERS){
				$centers[$i]['cid'] = $uid;
			}else{
				$students[($i-$NUM_CENTERS)]['sid'] = $uid; //!@#?
			}
			
			//Increment uid
			$uid++;
		}//for		
		
		
		//--------------------------------------------------------------------------------
		//STEP 3) SUBMITTING USER, CENTER, AND STUDENT VALUES TO DATABASE
		//--------------------------------------------------------------------------------
		
		//Users
		echo "\n\nInserting Users:";
		for($i = 0; $i < ($NUM_CENTERS+$NUM_STUDENTS); $i++) {
			//Submit Users
			DB::table('Users')->insert(
				[					
					'uid' => $users[$i]['uid'],
					'username' => $users[$i]['username'],
					'salt' => $users[$i]['salt'],
					'passwordHash' => $users[$i]['passwordHash'],
					'remember_token' => $users[$i]['remember_token'],
					'created_at' => $users[$i]['created_at'],
					'updated_at' => $users[$i]['updated_at']
				]
			);
			echo "\n\t- User ".$users[$i]['uid'].": ". $users[$i]['username'];
		}
		
		//Centers AND Students
		echo "\n\nInserting Centers/Students:";
		for($i = 0; $i < ($NUM_CENTERS+$NUM_STUDENTS); $i++) {
			//Submit Either Student OR Center
			if($i < $NUM_CENTERS){
				//use 'insertGetId' for grabbing auto-incremented field
				DB::table('Centers')->insert(
					[					
						'cid' => $centers[$i]['cid'],
						'name' => $centers[$i]['name'],
						'email' => $centers[$i]['email'],
						'phone' => $centers[$i]['phone'],
						'description' => $centers[$i]['description'],
						'canSupportOnlineExam' => $centers[$i]['canSupportOnlineExam'],
						'cost' => $centers[$i]['cost'],
						'street_name' => $centers[$i]['street_name'],
						'city' => $centers[$i]['city'],
						'province' => $centers[$i]['province'],
						'country' => $centers[$i]['country'],
						'postal_code' => $centers[$i]['postal_code'],
						'longitude' => $centers[$i]['longitude'],
						'latitude' => $centers[$i]['latitude']
					]
				);
				echo "\n\t- Center ".$centers[$i]['cid'].": ".$centers[$i]['name'];				
			}else{
				DB::table('Students')->insert(
					[					
						'sid' => $students[($i-$NUM_CENTERS)]['sid'],
						'firstName' => $students[($i-$NUM_CENTERS)]['firstName'],
						'lastName' => $students[($i-$NUM_CENTERS)]['lastName'],
						'email' => $students[($i-$NUM_CENTERS)]['email'],
						'gender' => $students[($i-$NUM_CENTERS)]['gender'],
						'age' => $students[($i-$NUM_CENTERS)]['age'],
						'phone' => $students[($i-$NUM_CENTERS)]['phone'],
						'created_at' => $students[($i-$NUM_CENTERS)]['created_at'],
						'updated_at' => $students[($i-$NUM_CENTERS)]['updated_at']
					]
				);
				echo "\n\t- Student ".$students[($i-$NUM_CENTERS)]['sid'].": ".$students[($i-$NUM_CENTERS)]['firstName']." ".$students[($i-$NUM_CENTERS)]['lastName'];
			}//if
		}//for	
		echo "\n";
	}//run
	
}//class


/*
OLD CODE:
//Collect all starting auto-increment id's (//!@#bodge)
		// https://laravel.com/docs/5.3/queries#retrieving-results
		//Users
		$uid=0;
		$result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Users'"));
		$result = get_object_vars($result[0]);
		$j=1;
		foreach ($result as $r){if($j==11){$uid=$r;break;}$j++;}
		//Students
		$sid=0;
		$result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Students'"));
		$result = get_object_vars($result[0]);
		$j=1;
		foreach ($result as $r){if($j==11){$sid=$r;break;}$j++;}
		//Centers
		$cid=0;
		$result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Centers'"));
		$result = get_object_vars($result[0]);
		$j=1;
		foreach ($result as $r){if($j==11){$cid=$r;break;}$j++;}
		//unset
		unset($result);
		unset($j);
		
		///Auto increment ID null check (//!@#bodge)
		if( is_null($sid) || is_null($uid) || is_null($cid) ){
			echo "\nFAILED TO IDENTIFY AN AUTO_INCREMENT PROPERTY. ";
			//echo "TERMINATING...\n\n";
			//return;
			//Instead of terminating, we're hardcoding any null auto_increments to 1
			is_null($sid) ? $sid=1 : "";
			is_null($cid) ? $cid=1 : "";
			is_null($uid) ? $uid=1 : "";
			echo "\n\n[NEW] ";
		}
		
		//Prompt With Results
		echo "Auto_Increment values for:";
		echo "\nUsers: ".$uid.".";
		echo "\nStudents: ".$sid.".";
		echo "\nCenters: ".$cid.".\n";
*/